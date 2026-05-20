<?php

require_once __DIR__ . '/../src/Classes/Router.php';

use App\Classes\Router;

$router = new Router();

$router->add('/', function() {
    require __DIR__ . '/../src/Views/home.php';
});

$router->add('/404', function() {
    require __DIR__ . '/../src/Views/404.php';
});

// Image processor route
$router->add('/img', function() {
    require __DIR__ . '/../src/Classes/ImageProcessor.php';
    $processor = new \App\Classes\ImageProcessor();
    $processor->handle();
});

$router->run();
