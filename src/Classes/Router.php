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
}
