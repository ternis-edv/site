<?php

namespace App\Classes;

class ImageProcessor {
    /**
     * Handle incoming image resizing request
     */
    public function handle() {
        $src = $_GET['src'] ?? null;
        $width = isset($_GET['w']) ? (int)$_GET['w'] : null;
        $quality = isset($_GET['q']) ? (int)$_GET['q'] : 85;

        if (!$src) {
            $this->error("Source image missing", 400);
        }

        // Clamp width and quality to safe ranges
        if ($width !== null) {
            $width = max(1, min(4096, $width));
        }
        $quality = max(1, min(100, $quality));

        // Resolve path and prevent directory traversal
        $baseDir = realpath(__DIR__ . '/../../');
        $rawPath = __DIR__ . '/../../' . ltrim($src, '/');
        $realPath = realpath($rawPath);

        if (!$realPath || !file_exists($realPath) || !str_starts_with($realPath, $baseDir)) {
            $this->error("Image not found: " . htmlspecialchars($src, ENT_QUOTES, 'UTF-8'), 404);
        }

        $info = @getimagesize($realPath);
        if (!$info) {
            $this->error("Invalid image file", 400);
        }

        $mime = $info['mime'] ?? 'application/octet-stream';
        $origWidth = $info[0] ?? 0;
        $origHeight = $info[1] ?? 0;

        // If no width specified or requested width >= original width, output original
        if (!$width || ($origWidth > 0 && $width >= $origWidth)) {
            $this->serveFile($realPath, $mime);
        }

        // Setup cache directory
        $cacheDir = __DIR__ . '/../../storage/cache/img';
        if (!is_dir($cacheDir)) {
            @mkdir($cacheDir, 0755, true);
        }

        $ext = pathinfo($realPath, PATHINFO_EXTENSION) ?: 'img';
        $cacheKey = md5($src . '_' . $width . '_' . $quality . '_' . filemtime($realPath)) . '.' . $ext;
        $cachePath = $cacheDir . '/' . $cacheKey;

        // Check if valid cache file exists
        if (file_exists($cachePath) && filemtime($cachePath) >= filemtime($realPath)) {
            $this->serveFile($cachePath, $mime, true);
        }

        // Perform resizing
        $this->resize($realPath, $mime, $origWidth, $origHeight, $width, $quality, $cachePath);
    }

    /**
     * Resize image using Imagick or GD with memory safety
     */
    private function resize($path, $mime, $origWidth, $origHeight, $width, $quality, $cachePath) {
        $ratio = ($origWidth > 0) ? ($origHeight / $origWidth) : 1;
        $height = max(1, (int)round($width * $ratio));

        // Attempt resizing via Imagick first if available (uses less PHP script memory)
        if (extension_loaded('imagick') && class_exists('\Imagick')) {
            try {
                if ($this->resizeWithImagick($path, $width, $height, $quality, $cachePath)) {
                    $this->serveFile($cachePath, $mime, false);
                }
            } catch (\Throwable $e) {
                // Fall back to GD
            }
        }

        // Adjust PHP memory limit for large images in GD
        $this->ensureMemoryForImage($origWidth, $origHeight);

        // Check if remaining memory is likely sufficient; if not, fallback to original
        if (!$this->isMemoryAvailableForGd($origWidth, $origHeight)) {
            $this->serveFile($path, $mime, false);
        }

        try {
            $srcImg = null;
            switch ($mime) {
                case 'image/jpeg':
                    $srcImg = @imagecreatefromjpeg($path);
                    break;
                case 'image/png':
                    $srcImg = @imagecreatefrompng($path);
                    break;
                case 'image/webp':
                    if (function_exists('imagecreatefromwebp')) {
                        $srcImg = @imagecreatefromwebp($path);
                    }
                    break;
                case 'image/gif':
                    $srcImg = @imagecreatefromgif($path);
                    break;
                case 'image/avif':
                    if (function_exists('imagecreatefromavif')) {
                        $srcImg = @imagecreatefromavif($path);
                    }
                    break;
            }

            if (!$srcImg) {
                // Graceful fallback to original file if decoding fails
                $this->serveFile($path, $mime, false);
            }

            $dstImg = imagecreatetruecolor($width, $height);
            if (!$dstImg) {
                if (is_resource($srcImg) || (PHP_VERSION_ID >= 80000 && $srcImg instanceof \GdImage)) {
                    @imagedestroy($srcImg);
                }
                $this->serveFile($path, $mime, false);
            }

            // Preserve transparency for PNG, WebP, GIF
            if ($mime === 'image/png' || $mime === 'image/webp' || $mime === 'image/gif') {
                imagealphablending($dstImg, false);
                imagesavealpha($dstImg, true);
                $transparent = imagecolorallocatealpha($dstImg, 255, 255, 255, 127);
                imagefilledrectangle($dstImg, 0, 0, $width, $height, $transparent);
            }

            imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);

            // Free source image memory immediately
            if (PHP_VERSION_ID < 80500) {
                @imagedestroy($srcImg);
            }
            unset($srcImg);

            // Save to temporary file first for atomic caching
            $tempPath = $cachePath . '.' . uniqid('tmp_', true);

            switch ($mime) {
                case 'image/jpeg':
                    imagejpeg($dstImg, $tempPath, $quality);
                    break;
                case 'image/png':
                    // Map 0-100 quality to 0-9 PNG compression level (default ~6)
                    $pngLevel = max(1, min(9, (int)round(9 - ($quality * 3 / 100))));
                    imagepng($dstImg, $tempPath, $pngLevel);
                    break;
                case 'image/webp':
                    if (function_exists('imagewebp')) {
                        imagewebp($dstImg, $tempPath, $quality);
                    } else {
                        imagejpeg($dstImg, $tempPath, $quality);
                    }
                    break;
                default:
                    imagejpeg($dstImg, $tempPath, $quality);
                    break;
            }

            if (PHP_VERSION_ID < 80500) {
                @imagedestroy($dstImg);
            }
            unset($dstImg);

            if (file_exists($tempPath)) {
                @rename($tempPath, $cachePath);
                $this->serveFile($cachePath, $mime, false);
            } else {
                $this->serveFile($path, $mime, false);
            }
        } catch (\Throwable $e) {
            // Clean up any temp file and fallback to original
            if (isset($tempPath) && file_exists($tempPath)) {
                @unlink($tempPath);
            }
            $this->serveFile($path, $mime, false);
        }
    }

    /**
     * Resize with Imagick
     */
    private function resizeWithImagick(string $path, int $width, int $height, int $quality, string $cachePath): bool {
        $imagick = new \Imagick($path);
        $imagick->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1);
        $imagick->setImageCompressionQuality($quality);
        $tempPath = $cachePath . '.' . uniqid('tmp_', true);
        $imagick->writeImage($tempPath);
        $imagick->clear();
        $imagick->destroy();

        if (file_exists($tempPath)) {
            @rename($tempPath, $cachePath);
            return true;
        }
        return false;
    }

    /**
     * Dynamically request higher memory limit based on image dimensions
     */
    private function ensureMemoryForImage(int $width, int $height): void {
        if ($width <= 0 || $height <= 0) {
            return;
        }

        // Estimate memory required by GD:
        // (width * height * 4 bytes RGBA) + buffers + destination image + safety margin
        $estimatedBytes = ($width * $height * 6) + (32 * 1024 * 1024);
        $currentLimitBytes = $this->getBytesFromMemoryLimit((string)ini_get('memory_limit'));

        if ($currentLimitBytes !== -1 && $currentLimitBytes < $estimatedBytes) {
            $targetMb = max(512, (int)ceil($estimatedBytes / (1024 * 1024)) + 64);
            @ini_set('memory_limit', "{$targetMb}M");
        }
    }

    /**
     * Check if estimated memory fits within current PHP memory limit
     */
    private function isMemoryAvailableForGd(int $width, int $height): bool {
        $limitBytes = $this->getBytesFromMemoryLimit((string)ini_get('memory_limit'));
        if ($limitBytes === -1) {
            return true;
        }

        $estimatedRequired = ($width * $height * 5);
        $usedMemory = memory_get_usage(true);

        return ($usedMemory + $estimatedRequired) < $limitBytes;
    }

    /**
     * Convert PHP memory limit string (e.g. "128M", "1G") to bytes
     */
    private function getBytesFromMemoryLimit(string $limit): int {
        $limit = trim($limit);
        if ($limit === '-1') {
            return -1;
        }

        $unit = strtolower(substr($limit, -1));
        $value = (int)$limit;

        switch ($unit) {
            case 'g':
                $value *= 1024 * 1024 * 1024;
                break;
            case 'm':
                $value *= 1024 * 1024;
                break;
            case 'k':
                $value *= 1024;
                break;
        }

        return $value;
    }

    /**
     * Serve image file with HTTP caching and conditional 304 response
     */
    private function serveFile(string $filePath, string $mime, bool $isCacheHit = false): void {
        if (!file_exists($filePath)) {
            $this->error("Image file not readable", 500);
        }

        $mtime = filemtime($filePath);
        $etag = '"' . md5($filePath . $mtime . filesize($filePath)) . '"';

        header("Content-Type: $mime");
        header("Cache-Control: public, max-age=31536000, immutable");
        header("ETag: $etag");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", $mtime) . " GMT");
        header("X-Cache: " . ($isCacheHit ? "HIT" : "MISS"));

        // Handle Conditional Requests (304 Not Modified)
        $ifNoneMatch = $_SERVER['HTTP_IF_NONE_MATCH'] ?? '';
        $ifModifiedSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '';

        if ($ifNoneMatch && trim($ifNoneMatch) === $etag) {
            http_response_code(304);
            exit;
        }

        if ($ifModifiedSince && @strtotime($ifModifiedSince) >= $mtime) {
            http_response_code(304);
            exit;
        }

        header("Content-Length: " . filesize($filePath));
        readfile($filePath);
        exit;
    }

    /**
     * Output JSON error
     */
    private function error($msg, $code = 500) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode(['error' => $msg, 'code' => $code]);
        exit;
    }
}
