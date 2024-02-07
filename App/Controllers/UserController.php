<?php

namespace App\Controllers;

class UserController
{
    public function index()
    {
        $users = include(__DIR__ . '/../Stubs/users.php');
        header('Content-Type: application/json');
        echo json_encode($users);
    }

    public function show($name)
    {
        $users = include(__DIR__ . '/../Stubs/users.php');
        foreach ($users as $user) {
            if ($user['name'] === $name) {
                header('Content-Type: application/json');
                echo json_encode($user);
                return;
            }
        }
        http_response_code(404);
        echo 'User not found';
    }
}
