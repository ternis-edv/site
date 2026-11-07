<?php

namespace App\Classes;

class LinkStats
{
    public static function get(): ?array
    {
        $cacheFile = __DIR__ . '/../../storage/cache/link-stats.json';
        $cached = is_file($cacheFile) ? json_decode((string) @file_get_contents($cacheFile), true) : null;
        $valid = static function ($data): bool {
            if (!is_array($data)) return false;
            foreach (['total_links', 'total_clicks', 'qr_codes'] as $key) {
                if (!isset($data[$key]) || !is_int($data[$key]) || $data[$key] < 0) return false;
            }
            return true;
        };
        $fallback = $valid($cached) ? $cached : null;
        if ($fallback !== null && filemtime($cacheFile) > time() - 300) return $fallback;

        $context = stream_context_create(['http' => [
            'timeout' => 2,
            'follow_location' => 0,
            'header' => "Accept: application/json\r\n",
        ]]);
        $response = @file_get_contents('https://links.t-api.de/v2/stats', false, $context);
        $payload = $response !== false ? json_decode($response, true) : null;
        $data = is_array($payload) ? ($payload['data'] ?? null) : null;
        if (!$valid($data) || !empty($payload['error'])) return $fallback;

        if (is_dir(dirname($cacheFile)) || @mkdir(dirname($cacheFile), 0755, true)) {
            @file_put_contents($cacheFile, json_encode($data), LOCK_EX);
        }
        return $data;
    }
}
