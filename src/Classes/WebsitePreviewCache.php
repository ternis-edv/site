<?php
namespace App\Classes;

/** A bounded, best-effort disk cache for anonymous upstream HTML. */
class WebsitePreviewCache {
    public const TTL = 7200;
    public const MAX_ENTRIES = 128;
    private const MAX_ENTRY_BYTES = 6 * 1024 * 1024;
    private const MAX_TOTAL_BYTES = 64 * 1024 * 1024;
    private string $directory;

    public function __construct(?string $directory = null) {
        $this->directory = $directory ?? __DIR__ . '/../../storage/cache/website-previews';
    }

    private function path(string $project, string $url): string {
        // Fragments do not affect the upstream document; queries do.
        $url = explode('#', $url, 2)[0];
        $parts = parse_url($url);
        if ($parts) {
            $url = strtolower($parts['scheme'] ?? 'https') . '://' . strtolower($parts['host'] ?? '')
                . ($parts['path'] ?? '/') . (isset($parts['query']) ? '?' . $parts['query'] : '');
        }
        return $this->directory . '/' . hash('sha256', $project . "\0" . $url) . '.json';
    }

    public function get(string $project, string $url): ?array {
        $path = $this->path($project, $url);
        clearstatcache(true, $path);
        if (!is_file($path)) return null;
        $modified = @filemtime($path);
        $size = @filesize($path);
        if (!$modified || $modified > time() || time() - $modified >= self::TTL || !$size || $size > self::MAX_ENTRY_BYTES) {
            @unlink($path);
            return null;
        }
        $content = @file_get_contents($path);
        $entry = $content === false ? null : json_decode($content, true);
        if (!is_array($entry) || !is_string($entry['url'] ?? null) || !is_string($entry['html'] ?? null) || trim($entry['html']) === '') {
            @unlink($path);
            return null;
        }
        return $entry;
    }

    public function put(string $project, string $url, string $finalUrl, string $html): void {
        if (trim($html) === '') return;
        $content = json_encode(['url' => explode('#', $finalUrl, 2)[0], 'html' => $html], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
        if ($content === false || strlen($content) > self::MAX_ENTRY_BYTES) return;
        if (!is_dir($this->directory) && !@mkdir($this->directory, 0755, true) && !is_dir($this->directory)) return;
        if (!is_writable($this->directory)) return;
        $temporary = @tempnam($this->directory, '.preview-');
        if ($temporary === false) return;
        // Rename within the directory so readers never observe a partial entry.
        if (@file_put_contents($temporary, $content, LOCK_EX) === strlen($content)) {
            @rename($temporary, $this->path($project, $url));
        }
        if (is_file($temporary)) @unlink($temporary);
        $this->prune();
    }

    private function prune(): void {
        $entries = [];
        $total = 0;
        foreach (glob($this->directory . '/*.json') ?: [] as $path) {
            clearstatcache(true, $path);
            $modified = @filemtime($path);
            $size = @filesize($path);
            if (!$modified || time() - $modified >= self::TTL || !$size || $size > self::MAX_ENTRY_BYTES) {
                @unlink($path);
                continue;
            }
            $entries[] = ['path' => $path, 'modified' => $modified, 'size' => $size];
            $total += $size;
        }
        usort($entries, static fn($a, $b) => $a['modified'] <=> $b['modified']);
        $count = count($entries);
        foreach ($entries as $entry) {
            if ($count <= self::MAX_ENTRIES && $total <= self::MAX_TOTAL_BYTES) break;
            if (@unlink($entry['path'])) {
                $count--;
                $total -= $entry['size'];
            }
        }
    }
}
