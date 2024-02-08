<?php

namespace App\Controllers;

use App\Enums\ResponseStatusCode;
use App\Exceptions\UserNotFoundException;
use App\Facades\Logger;
use App\Services\UserRetrieverService;

class UserController
{

    /**
     * @var UserRetrieverService
     */
    private UserRetrieverService $userRetrieverService;

    /**
     * UserController constructor
     */
    public function __construct()
    {
        $this->userRetrieverService = new UserRetrieverService();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->userRetrieverService->all());
    }

    /**
     * @param string $name
     * @return void
     */
    public function show(string $name): void
    {
        try {
            $user = $this->userRetrieverService->find($name);
            header('Content-Type: application/json');
            echo json_encode($user);
        } catch (UserNotFoundException $e) {

            Logger::log($e->getMessage());

            http_response_code(ResponseStatusCode::NOT_FOUND->value);
            echo $e->getMessage();
        }
    }
}
