<?php

namespace App\Controllers;

use App\Enums\ResponseStatusCode;
use App\Exceptions\UserNotFoundException;
use App\Facades\Logger;
use App\Facades\Response;
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
        Response::json(
            $this->userRetrieverService->all(),
            ResponseStatusCode::OK->value
        );
    }

    /**
     * @param string $name
     * @return void
     */
    public function show(string $name): void
    {
        try {
            Response::json(
                $this->userRetrieverService->find($name),
                ResponseStatusCode::OK->value
            );
        } catch (UserNotFoundException $e) {

            Logger::log($e->getMessage());

            Response::text(
                $e->getMessage(),
                ResponseStatusCode::NOT_FOUND->value
            );
        }
    }
}
