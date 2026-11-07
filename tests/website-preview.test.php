<?php
require __DIR__ . '/../src/Classes/WebsitePreview.php';
use App\Classes\WebsitePreview;
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
foreach (['http://dnbx.de', 'https://evil.test', 'https://dnbx.de.evil.test', 'https://user@dnbx.de', 'https://dnbx.de:8443', 'https://127.0.0.1', 'file:///etc/passwd'] as $url) {
    check(!WebsitePreview::allowedUrl($url, 'dnbx.de'), "Unsafe URL accepted: $url");
}
check(WebsitePreview::allowedUrl('https://www.dnbx.de/path?q=1', 'dnbx.de'), 'www redirect rejected');
check(WebsitePreview::resolveUrl('https://dnbx.de/docs/page', '../about') === 'https://dnbx.de/docs/../about', 'Relative URL resolution');
$_SERVER['HTTP_HOST'] = 'localhost:8765';
$html = (new WebsitePreview())->rewrite('<html><head><base href="https://evil.test"><meta http-equiv="refresh" content="0;url=https://evil.test"></head><body><a href="/about">About</a><a href="https://evil.test">External</a><img src="/image.png"></body></html>', 'https://dnbx.de/', 'dnbx.de', 'dnbx');
$doc = new DOMDocument();
@$doc->loadHTML($html);
check($doc->getElementsByTagName('base')->length === 1, 'Duplicate base');
check($doc->getElementsByTagName('base')->item(0)->getAttribute('href') === 'https://dnbx.de/', 'Asset base missing');
check(str_starts_with($doc->getElementsByTagName('a')->item(0)->getAttribute('href'), 'http://localhost:8765/preview?project=dnbx&url='), 'Internal navigation escapes proxy');
check(!$doc->getElementsByTagName('a')->item(1)->hasAttribute('href'), 'External navigation allowed');
check($doc->getElementsByTagName('meta')->length === 0, 'Refresh policy retained');
$_SERVER['REQUEST_URI'] = '/preview?project=dnbx';
$fragment = (new WebsitePreview())->rewrite('<p id="section">Hello</p><a href="#section">Jump</a>', 'https://dnbx.de/', 'dnbx.de', 'dnbx');
check(str_contains($fragment, '<head><base href="https://dnbx.de/">'), 'Missing head was not repaired');
check(str_contains($fragment, 'data-viewer-url="https://dnbx.de/#section"'), 'Fragment destination lost');
check(str_contains($fragment, 'url=https%3A%2F%2Fdnbx.de%2F%23section#section'), 'Fragment escaped proxy');
echo "Website proxy checks passed\n";

$crossProject = (new WebsitePreview())->rewrite('<a href="https://louixch.de/about?x=1#work">Allowed project</a><a href="https://hidden.test">Hidden</a>', 'https://dnbx.de/', 'dnbx.de', 'dnbx', [
    ['id' => 'dnbx', 'link' => 'https://dnbx.de'],
    ['id' => 'louixch', 'link' => 'https://louixch.de'],
    ['id' => 'hidden', 'link' => 'https://hidden.test', 'is_hidden' => true],
]);
$crossDoc = new DOMDocument();
@$crossDoc->loadHTML($crossProject);
check(str_contains($crossDoc->getElementsByTagName('a')->item(0)->getAttribute('href'), 'project=louixch'), 'Allowed project link blocked');
check(!$crossDoc->getElementsByTagName('a')->item(1)->hasAttribute('href'), 'Hidden project exposed');
check(str_contains($crossProject, 'viewer-bridge.js'), 'Navigation bridge missing');
echo "Cross-project navigation checks passed\n";
