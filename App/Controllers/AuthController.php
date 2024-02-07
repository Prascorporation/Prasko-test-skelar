<?php

namespace App\Controllers;

session_start();

class AuthController
{
    public function login()
    {
        if ($username === 'admin' && $password === 'password') {
            $_SESSION['user'] = $username;
        } else {
        }
    }

    public function register()
    {
        echo "Register";
    }
}
