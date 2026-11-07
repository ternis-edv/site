<?php
namespace App\Classes;

/** Read-only HTML previews, restricted to published portfolio hosts. */
class WebsitePreview {
    public static function resolveUrl(string $base, string $reference): string {
        if (preg_match('~^https?://~i', $reference)) return $reference;
        $parts = parse_url($base);
        $origin = 'https://' . $parts['host'];
        if (str_starts_with($reference, '//')) return 'https:' . $reference;
        if (str_starts_with($reference, '#')) return explode('#', $base, 2)[0] . $reference;
        if (str_starts_with($reference, '?')) return $origin . ($parts['path'] ?? '/') . $reference;
        return $origin . (str_starts_with($reference, '/') ? $reference : preg_replace('~/[^/]*$~', '/', $parts['path'] ?? '/') . $reference);
    }

    public static function allowedUrl(string $url, string $host): bool {
        $parts = parse_url($url);
        return $parts && ($parts['scheme'] ?? '') === 'https'
            && in_array(strtolower($parts['host'] ?? ''), [$host, 'www.' . $host], true)
            && !isset($parts['user']) && !isset($parts['pass']) && !isset($parts['port']);
    }

    public function handle(array $projects): void {
        header('X-Robots-Tag: noindex, nofollow');
        header('Cache-Control: no-store');
        header('Referrer-Policy: no-referrer');
        header("Content-Security-Policy: sandbox allow-scripts; frame-ancestors 'self'; form-action 'none'; object-src 'none'; worker-src 'none'");
        header('Content-Type: text/html; charset=utf-8');
        header('X-Content-Type-Options: nosniff');
        try {
            $id = is_string($_GET['project'] ?? null) ? $_GET['project'] : '';
            $project = current(array_filter($projects, static fn($p) => empty($p['is_hidden']) && $p['id'] === $id));
            if (!$project || !str_starts_with($project['link'], 'https://')) throw new \RuntimeException('Dieses Projekt ist nur als Screenshot verfügbar.');
            $host = preg_replace('/^www\./', '', strtolower(parse_url($project['link'], PHP_URL_HOST)));
            $url = $_GET['url'] ?? $project['link'];
            if (!is_string($url) || strlen($url) > 4096) throw new \RuntimeException('Ungültige Vorschau-Adresse.');
            if (!self::allowedUrl($url, $host)) throw new \RuntimeException('Diese Adresse gehört nicht zum ausgewählten Projekt.');
            $requestedUrl = $url;
            $fragment = parse_url($url, PHP_URL_FRAGMENT);
            $url = explode('#', $url, 2)[0];
            $cache = new WebsitePreviewCache();
            $cached = $cache->get($id, $requestedUrl);
            if ($cached && self::allowedUrl($cached['url'], $host)) {
                $finalUrl = $cached['url'] . ($fragment !== null ? '#' . $fragment : '');
                $rendered = $this->rewrite($cached['html'], $finalUrl, $host, $id, $projects);
                header('X-Preview-Cache: HIT');
                echo $rendered;
                return;
            }
            header('X-Preview-Cache: MISS');
            $html = '';
            for ($attempt = 0; $attempt < 4; $attempt++) {
                if (!self::allowedUrl($url, $host)) throw new \RuntimeException('Diese Adresse gehört nicht zum ausgewählten Projekt.');
                $targetHost = parse_url($url, PHP_URL_HOST);
                $addresses = gethostbynamel($targetHost) ?: [];
                if (!$addresses) throw new \RuntimeException('Die Website ist momentan nicht erreichbar.');
                foreach ($addresses as $address) {
                    if (!filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) throw new \RuntimeException('Diese Website kann hier nicht geladen werden.');
                }
                $html = '';
                $location = null;
                $curl = curl_init($url);
                curl_setopt_array($curl, [
                    CURLOPT_RESOLVE => ["$targetHost:443:" . $addresses[0]],
                    CURLOPT_PROXY => '', CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                    CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 15,
                    CURLOPT_USERAGENT => 'ternis-edv Portfolio Preview/1.0',
                    CURLOPT_ENCODING => '',
                    CURLOPT_HEADERFUNCTION => static function ($curl, $line) use (&$location) {
                        if (stripos($line, 'location:') === 0) $location = trim(substr($line, 9));
                        return strlen($line);
                    },
                    CURLOPT_WRITEFUNCTION => static function ($curl, $chunk) use (&$html) {
                        if (strlen($html) + strlen($chunk) > 5 * 1024 * 1024) return 0;
                        $html .= $chunk;
                        return strlen($chunk);
                    },
                ]);
                $success = curl_exec($curl);
                $status = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
                $type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE) ?: '';
                unset($curl);
                if ($success === false) throw new \RuntimeException('Die Website konnte nicht vollständig geladen werden.');
                if ($status >= 300 && $status < 400 && $location) {
                    $url = self::resolveUrl($url, $location);
                    continue;
                }
                if ($status < 200 || $status >= 300 || stripos($type, 'text/html') === false) throw new \RuntimeException('Für diese Adresse ist keine HTML-Vorschau verfügbar.');
                $finalUrl = explode('#', $url, 2)[0] . ($fragment !== null ? '#' . $fragment : '');
                $rendered = $this->rewrite($html, $finalUrl, $host, $id, $projects);
                $cache->put($id, $requestedUrl, $url, $html);
                echo $rendered;
                return;
            }
            throw new \RuntimeException('Die Website leitet zu häufig weiter.');
        } catch (\RuntimeException $error) {
            http_response_code(502);
            echo '<!doctype html><html lang="de"><meta charset="utf-8"><meta name="viewport" content="width=device-width"><title>Vorschau nicht verfügbar</title><body style="font:16px/1.6 system-ui;padding:clamp(24px,8vw,96px);background:#151719;color:#f5f5f5"><h1>Vorschau nicht verfügbar</h1><p>' . htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8') . '</p><p>Wähle oben „Screenshot“ oder öffne die Website direkt.</p></body></html>';
        }
    }

    private function localOrigin(): string {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        if (!preg_match('/^[a-zA-Z0-9.\-]+(?::[0-9]+)?$/', $host)) $host = 'localhost';
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $host;
    }

    public function rewrite(string $html, string $url, string $host, string $id, array $projects = []): string {
        if (trim($html) === '') throw new \RuntimeException('Die Website hat keinen Inhalt geliefert.');
        $doc = new \DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        // Remove upstream base URLs and policies; the sandbox is set by this server.
        foreach (iterator_to_array($doc->getElementsByTagName('base')) as $node) $node->parentNode->removeChild($node);
        foreach (iterator_to_array($doc->getElementsByTagName('meta')) as $node) {
            if ($node->hasAttribute('http-equiv')) $node->parentNode->removeChild($node);
        }
        $eligible = array_values(array_filter($projects, static fn($p) => empty($p['is_hidden']) && str_starts_with($p['link'], 'https://')));
        if (!$eligible) $eligible = [['id' => $id, 'link' => 'https://' . $host]];
        foreach ($doc->getElementsByTagName('a') as $link) {
            $href = $link->getAttribute('href');
            if (!$href) continue;
            $absolute = self::resolveUrl($url, $href);
            $target = null;
            foreach ($eligible as $candidate) {
                $candidateHost = preg_replace('/^www\./', '', strtolower(parse_url($candidate['link'], PHP_URL_HOST)));
                if (self::allowedUrl($absolute, $candidateHost)) { $target = $candidate; break; }
            }
            if ($target) {
                $fragment = parse_url($absolute, PHP_URL_FRAGMENT);
                $link->setAttribute('href', $this->localOrigin() . '/preview?project=' . rawurlencode($target['id']) . '&url=' . rawurlencode($absolute) . ($fragment !== null ? '#' . $fragment : ''));
                $link->setAttribute('data-viewer-url', $absolute);
                $link->setAttribute('target', '_self');
            } else {
                $link->removeAttribute('href');
                $link->setAttribute('title', 'Externe Links bitte auf der Originalwebsite öffnen');
            }
        }
        $head = $doc->getElementsByTagName('head')->item(0);
        if (!$head) {
            $head = $doc->createElement('head');
            $doc->documentElement->insertBefore($head, $doc->documentElement->firstChild);
        }
        $base = $doc->createElement('base');
        $base->setAttribute('href', $url);
        $head->insertBefore($base, $head->firstChild);
        $bridge = $doc->createElement('script');
        $bridge->setAttribute('src', $this->localOrigin() . '/assets/js/viewer-bridge.js?v=' . filemtime(__DIR__ . '/../../assets/js/viewer-bridge.js'));
        $bridge->setAttribute('data-viewer', json_encode([
            'origin' => $this->localOrigin(), 'project' => $id, 'url' => $url,
            'projects' => array_map(static fn($p) => ['id' => $p['id'], 'link' => $p['link']], $eligible),
        ], JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE));
        $head->insertBefore($bridge, $base->nextSibling);
        foreach (iterator_to_array($doc->childNodes) as $node) {
            if ($node->nodeType === XML_PI_NODE) $doc->removeChild($node);
        }
        return $doc->saveHTML();
    }
}
