<?php

namespace App\Facades;

class Router
{
    protected static $routes = [
        'user' => ['UserController@index', 'authenticate'],
        'user/([^/]+)' => ['UserController@show', 'authenticate']
    ];

    public function addRoute($pattern, $handler)
    {
        $this->routes[$pattern] = $handler;
    }


    public static function dispatch($requestUri)
    {
        foreach (self::$routes as $pattern => $routeData) {
            if (preg_match("#^{$pattern}$#", $requestUri, $matches)) {
                $params = array_slice($matches, 1);

                list($controllerAction, $middleware) = $routeData;

                if (function_exists($middleware)) {
                    call_user_func($middleware);
                }

                list($controllerName, $actionName) = explode('@', $controllerAction);

                $controller = new $controllerName();

                call_user_func_array([$controller, $actionName], $params);

                exit();
            }
        }
    }
}
