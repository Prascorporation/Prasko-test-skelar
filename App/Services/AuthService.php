<?php

namespace App\Services;

use App\Facades\Logger;

class AuthService
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password): bool
    {
        session_start();
        $credentials = require __DIR__ . '/../Stubs/credentials.php';

        if (
            $username === $credentials['username']
            && $password === $credentials['password']
        ) {
            $_SESSION['user'] = $username;
            return true;
        }
        return false;
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        session_start();
        session_destroy();
    }
}
