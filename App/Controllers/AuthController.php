<?php

namespace App\Controllers;

use App\Enums\ResponseStatusCode;
use App\Facades\Logger;
use App\Services\AuthService;

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
        $username = $params['username'];
        $password = $params['password'];

        $positiveResponse = $this->authService->login($username, $password);

        if ($positiveResponse) {
            http_response_code(ResponseStatusCode::OK->value);
            $_SESSION['user'] = $username;
            echo "Logged in";
            Logger::log("User $username logged in");
        } else {
            http_response_code(ResponseStatusCode::UNAUTHORIZED->value);
            echo "Wrong credentials provided";
            Logger::log("Failed login attempt for user $username");
        }
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        session_start();
        session_destroy();
        http_response_code(ResponseStatusCode::OK->value);

        Logger::log("User logged out");

        echo "Logged out";
    }
}
