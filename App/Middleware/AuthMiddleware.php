<?php

namespace App\Middleware;

use App\Enums\ResponseStatusCode;
use App\Facades\Response;
use App\Middleware\AbstractMiddleware;

class AuthMiddleware extends AbstractMiddleware
{
    /**
     * @return void
     */
    public function handle(): void
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            Response::text(
                'Unauthorized',
                ResponseStatusCode::UNAUTHORIZED->value
            );
            exit();
        }
    }
}
