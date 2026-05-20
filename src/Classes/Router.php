<?php

namespace App\Classes;

class Router {
    private $routes = [];

    public function add($path, $callback) {
        $this->routes[$path] = $callback;
    }

    public function run() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Remove 'public/' from path if present (for local dev without vhost)
        $path = str_replace('/public', '', $path);
        
        // Handle assets
        if (strpos($path, '/assets/') === 0) {
            $this->serveAsset(ltrim($path, '/'));
            return;
        }

        // Handle sitemap
        if ($path === '/sitemap.xml') {
            $this->generateSitemap();
            return;
        }

        if (isset($this->routes[$path])) {
            return call_user_func($this->routes[$path]);
        }

        // 404
        http_response_code(404);
        if (isset($this->routes['/404'])) {
            return call_user_func($this->routes['/404']);
        }
        echo "404 Not Found";
    }

    private function serveAsset($path) {
        $realPath = realpath(__DIR__ . '/../../' . $path);
        if (!$realPath || !file_exists($realPath) || is_dir($realPath)) {
            http_response_code(404);
            return;
        }

        $ext = pathinfo($realPath, PATHINFO_EXTENSION);
        $mimes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp',
            'ico' => 'image/x-icon'
        ];

        $mime = $mimes[$ext] ?? 'application/octet-stream';
        header("Content-Type: $mime");
        // Add caching headers for assets
        header("Cache-Control: public, max-age=31536000");
        readfile($realPath);
    }

    private function generateSitemap() {
        header("Content-Type: application/xml");
        $host = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($this->routes as $path => $callback) {
            if ($path === '/404' || $path === '/img' || strpos($path, ':') !== false) continue;
            
            echo '<url>';
            echo '<loc>' . $host . $path . '</loc>';
            echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
            echo '<changefreq>monthly</changefreq>';
            echo '<priority>' . ($path === '/' ? '1.0' : '0.8') . '</priority>';
            echo '</url>';
        }
        
        echo '</urlset>';
    }
}
