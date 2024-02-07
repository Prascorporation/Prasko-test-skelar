<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo 'Unauthorized';
            exit();
        }

        return $next($request);
    }
}
