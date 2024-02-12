<?php

namespace App\Routing;

use App\Exceptions\MethodNotAllowedException;
use App\Exceptions\PageNotFoundException;
use App\Services\RouterService;

class Router
{
    /**
     * @var array
     */
    private array $routes = [];

    /**
     * @var RouterService
     */
    private RouterService $routerService;

    /**
     * Router constructor
     */
    public function __construct()
    {
        $this->loadRoutes();
        $this->routerService = new RouterService();
    }

    /**
     * @param string $requestUri
     * @param string $requestType
     * @return void
     */
    public function dispatch(string $requestUri, string $requestType): void
    {
        foreach ($this->routes as $route) {

            $pattern = $this->routerService->getUriPattern($route->uri);

            if (preg_match($pattern, $requestUri)) {
                if (! $this
                    ->routerService
                    ->isMethodAllowed($route->requestType, $requestType)) {
                    throw new MethodNotAllowedException($requestType);
                }

                if ($route->middleware) {
                    $this->handleMiddleware($route->middleware);
                }

                $this->callController($route, $requestUri);
                return;
            }
        }

        throw new PageNotFoundException($requestUri);
    }

    /**
     * @return void
     */
    private function loadRoutes(): void
    {
        $this->routes = include(__DIR__ . '/../routes.php');
    }

    /**
     * @param Route $route
     * @param string $requestUri
     * @return void
     */
    private function callController(Route $route, string $requestUri): void
    {
        $parameters = $this->getParameters($route->requestType, $requestUri);

        list($controller, $action) = explode('@', $route->controllerAction);
        $controller = "App\\Controllers\\$controller";

        (new $controller())->$action($parameters);
    }

    /**
     * @param string $middleware
     * @return mixed
     */
    private function getParameters(string $requestType, string $requestUri): mixed
    {
        return match ($requestType) {
            'GET' =>  basename(parse_url($requestUri, PHP_URL_PATH)),
            'POST' => json_decode(file_get_contents('php://input'), true),
            default => null,
        };
    }

    /**
     * @param string $middleware
     * @return void
     */
    private function handleMiddleware(string $middleware): void
    {
        $middleware = "App\\Middleware\\$middleware";
        (new $middleware())->handle();
    }
}
