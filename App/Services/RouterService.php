<?php

namespace App\Services;

class RouterService
{
    /**
     * @param string $routeMethod
     * @param string $requestMethod
     * @return bool
     */
    public function isMethodAllowed(string $routeMethod, string $requestMethod): bool
    {
        return $routeMethod === $requestMethod;
    }

    /**
     * @param string $uri
     * @return string
     */
    public function getUriPattern(string $uri): string
    {
        if ($this->hasDynamicParameter($uri)) {
            return $this->getDynamicUriPattern($uri);
        }

        $uri = preg_quote($uri, '#');
        return '#^' . $uri . '/?$#';
    }

    /**
     * @param string $uri
     * @return bool
     */
    private function hasDynamicParameter(string $uri): bool
    {
        return strpos($uri, '{$') !== false;
    }

    /**
     * @param string $uri
     * @return string
     */
    private function getDynamicUriPattern(string $uri): string
    {
        $uri = preg_replace('/{\$[^}]+}/', '([^/]+)', $uri);
        $uri .= '\/?\d*';
        return '#^' . $uri . '$#';
    }
}
