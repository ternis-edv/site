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

$router->add('/impressum', function() {
    require __DIR__ . '/../src/Views/impressum.php';
});

$router->add('/datenschutz', function() {
    require __DIR__ . '/../src/Views/datenschutz.php';
});

// Image processor route
$router->add('/img', function() {
    $processor = new ImageProcessor();
    $processor->handle();
});

$router->add('/preview', function() {
    require __DIR__ . '/../src/Views/partials/projects_data.php';
    (new App\Classes\WebsitePreview())->handle($projects);
});

$router->addPrefix('/viewer/', function($path) {
    require_once __DIR__ . '/../src/Views/partials/projects_data.php';
    $id = explode('/', substr($path, strlen('/viewer/')), 2)[0];
    $project = current(array_filter($projects, static fn($p) => empty($p['is_hidden']) && $p['id'] === $id));
    if (!$project) {
        http_response_code(404);
        require __DIR__ . '/../src/Views/404.php';
        return;
    }
    header('X-Robots-Tag: noindex, nofollow');
    $viewerRoute = true;
    $pageTitle = $project['name'] . ' — Website-Viewer · ternis-edv';
    require __DIR__ . '/../src/Views/home.php';
});

$router->run();
