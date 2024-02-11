<?php

namespace App\Routing;

class Route
{

    /**
     * @var string
     */
    public string $uri;

    /**
     * @var string
     */
    public string $controllerAction;

    /**
     * @var string
     */
    public string $requestType;

    /**
     * @var string|null
     */
    public ?string $middleware = null;

    /**
     * Route constructor
     * @param string $uri
     * @param string $controllerAction
     * @param string $requestType
     */
    public function __construct(string $uri, string $controllerAction, string $requestType)
    {
        $this->uri = $uri;
        $this->controllerAction = $controllerAction;
        $this->requestType = $requestType;
    }

    /**
     * @param string $uri
     * @param string $controllerAction
     * @return Route
     */
    public static function get(string $uri, string $controllerAction): Route
    {
        return new static($uri, $controllerAction, 'GET');
    }

    /**
     * @param string $uri
     * @param string $controllerAction
     * @return Route
     */
    public static function post(string $uri, string $controllerAction): Route
    {
        return new static($uri, $controllerAction, 'POST');
    }

    /**
     * @param string $middleware
     * @return Route
     */
    public function middleware(string $middleware): Route
    {
        $this->middleware = $middleware;
        return $this;
    }
}
