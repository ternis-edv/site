<?php

namespace App\Classes;

class ImageProcessor {
    public function handle() {
        $src = $_GET['src'] ?? null;
        $width = isset($_GET['w']) ? (int)$_GET['w'] : null;
        $quality = isset($_GET['q']) ? (int)$_GET['q'] : 80;

        if (!$src) {
            $this->error("Source image missing", 400);
        }

        $realPath = realpath(__DIR__ . '/../../public/' . $src);
        if (!$realPath || !file_exists($realPath)) {
            $this->error("Image not found: " . $src, 404);
        }

        $info = getimagesize($realPath);
        if (!$info) {
            $this->error("Invalid image file", 400);
        }

        $mime = $info['mime'];
        header("Content-Type: $mime");

        // If no width specified, just output the original (with potential quality loss for JPEGs)
        if (!$width) {
            readfile($realPath);
            exit;
        }

        $this->resize($realPath, $mime, $width, $quality);
    }

    private function resize($path, $mime, $width, $quality) {
        list($origWidth, $origHeight) = getimagesize($path);
        $ratio = $origHeight / $origWidth;
        $height = (int)($width * $ratio);

        $srcImg = null;
        switch ($mime) {
            case 'image/jpeg': $srcImg = imagecreatefromjpeg($path); break;
            case 'image/png': $srcImg = imagecreatefrompng($path); break;
            case 'image/webp': $srcImg = imagecreatefromwebp($path); break;
            default: $this->error("Unsupported mime type: " . $mime, 400);
        }

        $dstImg = imagecreatetruecolor($width, $height);

        // Preserve transparency for PNG and WebP
        if ($mime == 'image/png' || $mime == 'image/webp') {
            imagealphablending($dstImg, false);
            imagesavealpha($dstImg, true);
        }

        imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);

        switch ($mime) {
            case 'image/jpeg': imagejpeg($dstImg, null, $quality); break;
            case 'image/png': 
                $pngQuality = (int)((100 - $quality) / 10); // 0-9 for PNG
                imagepng($dstImg, null, $pngQuality); 
                break;
            case 'image/webp': imagewebp($dstImg, null, $quality); break;
        }

        imagedestroy($srcImg);
        imagedestroy($dstImg);
        exit;
    }

    private function error($msg, $code = 500) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode(['error' => $msg, 'code' => $code]);
        exit;
    }
}
