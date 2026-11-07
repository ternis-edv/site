<?php
require __DIR__ . '/../src/Classes/WebsitePreviewCache.php';
use App\Classes\WebsitePreviewCache;
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
$directory = sys_get_temp_dir() . '/ternis-preview-cache-' . bin2hex(random_bytes(6));
$cache = new WebsitePreviewCache($directory);
try {
    check($cache->get('dnbx', 'https://dnbx.de') === null, 'Missing entry was a hit');
    $cache->put('dnbx', 'https://dnbx.de', 'https://www.dnbx.de/', '<h1>Cached page</h1>');
    $entry = $cache->get('dnbx', 'https://dnbx.de/');
    check($entry === ['url' => 'https://www.dnbx.de/', 'html' => '<h1>Cached page</h1>'], 'Raw HTML or redirect target lost');
    check($cache->get('dnbx', 'https://DNBX.de/#section') === $entry, 'Fragment or hostname case duplicated the document');
    check($cache->get('other-project', 'https://dnbx.de/') === null, 'Project keys overlap');
    check($cache->get('dnbx', 'https://dnbx.de/?page=2') === null, 'Query keys overlap');
    $file = glob($directory . '/*.json')[0];
    touch($file, time() - WebsitePreviewCache::TTL);
    check($cache->get('dnbx', 'https://dnbx.de/') === null, 'Two-hour entry did not expire');
    check(!file_exists($file), 'Expired entry was not removed');
    $cache->put('dnbx', 'https://dnbx.de/', 'https://dnbx.de/', '<p>Fresh page</p>');
    check($cache->get('dnbx', 'https://dnbx.de/')['html'] === '<p>Fresh page</p>', 'Expired entry could not be refreshed');
    file_put_contents($file, '{broken');
    check($cache->get('dnbx', 'https://dnbx.de/') === null, 'Corrupt JSON was returned');
    $cache->put('dnbx', 'https://dnbx.de/empty', 'https://dnbx.de/empty', '  ');
    check($cache->get('dnbx', 'https://dnbx.de/empty') === null, 'Empty document cached');
    for ($index = 0; $index <= WebsitePreviewCache::MAX_ENTRIES; $index++) {
        $cache->put('dnbx', "https://dnbx.de/page/$index", "https://dnbx.de/page/$index", '<p>Page</p>');
    }
    check(count(glob($directory . '/*.json')) === WebsitePreviewCache::MAX_ENTRIES, 'Cache entry count is unbounded');
    check(count(glob($directory . '/.preview-*')) === 0, 'Temporary write files were left behind');
    $blocked = $directory . '/not-a-directory';
    file_put_contents($blocked, 'file');
    $unavailable = new WebsitePreviewCache($blocked);
    $unavailable->put('dnbx', 'https://dnbx.de/', 'https://dnbx.de/', '<p>Page</p>');
    check($unavailable->get('dnbx', 'https://dnbx.de/') === null, 'Unavailable storage should behave as a cache miss');
    echo "Website preview cache checks passed (hit, expiry, isolation, corruption, limits, unavailable storage)\n";
} finally {
    foreach (glob($directory . '/*') ?: [] as $file) unlink($file);
    foreach (glob($directory . '/.preview-*') ?: [] as $file) unlink($file);
    if (is_dir($directory)) rmdir($directory);
}
