<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Enums\ResponseStatusCode;
use App\Exceptions\PageNotFoundException;
use App\Facades\Response;
use App\Routing\Router;

$requestUri = $_SERVER['REQUEST_URI'];

$requestMethod = $_SERVER['REQUEST_METHOD'];

$router = new Router();

try {
    $router->dispatch($requestUri, $requestMethod);
} catch (PageNotFoundException $e) {
    Response::text(
        $e->getMessage(),
        ResponseStatusCode::NOT_FOUND->value
    );
}
