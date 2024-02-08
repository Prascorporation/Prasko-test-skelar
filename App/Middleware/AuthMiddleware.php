<?php

namespace App\Middleware;

use App\Middleware\AbstractMiddleware;

class AuthMiddleware extends AbstractMiddleware
{
    public function handle()
    {
        session_start();
        if (! isset($_SESSION['user'])) {
            http_response_code(401);
            echo 'Unauthorized';
            exit();
        }
        return;
    }
}
