<?php

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

use App\Classes\Router;
use App\Classes\ImageProcessor;

$router = new Router();

$router->add('/', function() {
    require __DIR__ . '/../src/Views/home.php';
});

$router->add('/404', function() {
    require __DIR__ . '/../src/Views/404.php';
});

// Image processor route
$router->add('/img', function() {
    $processor = new ImageProcessor();
    $processor->handle();
});

$router->run();
