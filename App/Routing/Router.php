<?php

namespace App\Routing;

use App\Enums\ResponseStatusCode;
use App\Facades\Response;
use App\Middleware\AuthMiddleware;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = include(__DIR__ . '/../routes.php');
    }

    /**
     * main method to find the route and dispatch the request
     * @param string $requestUri
     * @return void
     */
    public function dispatch($requestUri)
    {
        $requestUri = rtrim($requestUri, '/');

        foreach ($this->routes as $pattern => $controllerAction) {

            if (preg_match("#^{$pattern}$#", $requestUri, $matches)) {
                $requestType = $_SERVER['REQUEST_METHOD'];

                $params = $this->getParams($requestType, $matches);

                if (in_array('authenticate', $controllerAction)) {
                    $middleware = new AuthMiddleware();
                    $middleware->handle();
                }

                $this->checkRequestType($requestType, $controllerAction[2]);

                list($controllerName, $actionName) = explode('@', $controllerAction[0]);

                $name = "App\Controllers\\$controllerName";
                $controller = new $name();

                $controller->$actionName($params);

                exit();
            }
        }
    }

    /**
     * 
     * @param string $requestType
     * @param array $matches
     * @return array|string
     */
    private function getParams(string $requestType, array $matches): array|string
    {
        if ($requestType == 'GET') {
            array_slice($matches, 1);
            return count($matches) > 1 ? end($matches) : $matches[0];
        } elseif ($requestType == 'POST') {
            return json_decode(file_get_contents('php://input'), true);
        }
    }

    /**
     * @param string $requestType
     * @param string $methodRequestType
     * @return void
     */
    private function checkRequestType(string $requestType, string $methodRequestType)
    {
        if ($requestType !== $methodRequestType) {

            Response::text(
                'Method not allowed',
                ResponseStatusCode::NOT_ALLOWED->value
            );
            exit();
        }
    }
}
