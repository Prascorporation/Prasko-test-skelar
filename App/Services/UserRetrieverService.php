<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;

class UserRetrieverService
{
    /**
     * @var array
     */
    private array $users;

    /**
     * UserRetrieverService constructor
     */
    public function __construct()
    {
        $this->users = include(__DIR__ . '/../Stubs/users.php');
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->users;
    }

    /**
     * @param string $name
     * @return array
     */
    public function find(string $name): array
    {
        foreach ($this->users as $user) {
            if ($user['name'] === $name) {
                return $user;
            }
        }
        throw new UserNotFoundException($name);
    }
}
