<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;

$requestUri = $_SERVER['REQUEST_URI'];

$routes = [
    '/user' => 'UserController@index',
    '/user/([^/]+)' => 'UserController@show',
    '/auth/login' => 'AuthController@login',
];

foreach ($routes as $pattern => $controllerAction) {
    if (preg_match("#^{$pattern}$#", $requestUri, $matches)) {
        $params = array_slice($matches, 1);

        list($controllerName, $actionName) = explode('@', $controllerAction);
        $controller = new UserController();

        call_user_func_array([$controller, $actionName], $params);

        exit();
    }
}

http_response_code(404);
echo '404 Not Found';
