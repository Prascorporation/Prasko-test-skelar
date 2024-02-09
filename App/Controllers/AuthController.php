<?php

namespace App\Controllers;

use App\Enums\ResponseStatusCode;
use App\Facades\Logger;
use App\Facades\Response;
use App\Services\AuthService;
use InvalidArgumentException;

class AuthController
{
    /*
    * @var AuthService
    */
    private AuthService $authService;

    /**
     * AuthController constructor
     */
    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * @param array $params
     * @return void
     */
    public function login(array $params): void
    {
        try {
            $this->validateLogin($params);
        } catch (InvalidArgumentException $e) {
            Response::text(
                $e->getMessage(),
                ResponseStatusCode::BAD_REQUEST->value
            );
            return;
        }

        $username = $params['username'];
        $password = $params['password'];

        $positiveResponse = $this->authService->login($username, $password);

        if ($positiveResponse) {
            $_SESSION['user'] = $username;

            Response::text("Logged in", ResponseStatusCode::OK->value);

            Logger::log("User $username logged in");
        } else {

            Logger::log("Failed login attempt for user $username");
            Response::text("Failed login attempt", ResponseStatusCode::UNAUTHORIZED->value);
        }
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        session_start();
        session_destroy();

        Logger::log("User logged out");

        Response::text("Logged out", ResponseStatusCode::OK->value);
    }

    /**
     * @param array $params
     * @return void
     */
    private function validateLogin(array $params): void
    {
        if (
            ! isset($params['username']) ||
            ! isset($params['password'])
        ) {
            throw new InvalidArgumentException("username and password are required");
        }
    }
}
