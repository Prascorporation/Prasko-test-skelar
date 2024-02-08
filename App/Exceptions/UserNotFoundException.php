<?php

namespace App\Exceptions;

class UserNotFoundException extends \Exception
{
    /**
     * UserNotFoundException constructor
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct("User with name $name not found");
    }
}
