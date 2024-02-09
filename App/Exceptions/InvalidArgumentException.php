<?php

namespace App\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
    /**
     * InvalidArgumentException constructor
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
