<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Routing\Router;

$requestUri = $_SERVER['REQUEST_URI'];

$router = new Router($requestUri);
$router->dispatch($requestUri);

http_response_code(404);
echo '404 Not Found';
