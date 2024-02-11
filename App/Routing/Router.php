<?php

namespace App\Routing;

use App\Enums\ResponseStatusCode;
use App\Exceptions\MethodNotAllowedException;
use App\Exceptions\PageNotFoundException;
use App\Facades\Response;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function dispatch(string $requestUri, string $requestType)
    {
        foreach ($this->routes as $route) {
            $pattern = $this->getUriPattern($route->uri);
            if (preg_match($pattern, $requestUri)) {
                echo 'Route found';
                return;
                $this->handleRoute($route->controllerAction);
            }
        }
        throw new PageNotFoundException($requestUri);
    }

    private function isMethodAllowed(string $routeMethod, string $requestMethod)
    {
        return $routeMethod === $requestMethod;
    }

    private function loadRoutes()
    {
        $this->routes = include(__DIR__ . '/../routes.php');
    }

    public function getUriPattern(string $uri): string
    {
        if ($this->hasDynamicParameter($uri)) {
            return $this->getDynamicUriPattern($uri);
        }

        $escapedUri = preg_quote($uri, '#');
        return '#^' . $escapedUri . '/?$#';
    }

    private function hasDynamicParameter(string $uri): bool
    {
        return strpos($uri, '{$') !== false;
    }

    private function getDynamicUriPattern(string $uri): string
    {
        $uri = preg_replace('/{\$[^}]+}/', '([^/]+)', $uri);

        $uri .= '\/?\d*';

        return '#^' . $uri . '$#';
    }
    private function handleRoute(string $controllerAction)
    {
        list($controller, $action) = explode('@', $controllerAction);
    }
}
