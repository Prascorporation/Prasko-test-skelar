<?php

namespace App\Exceptions;

class MethodNotAllowedException extends \Exception
{
    public function __construct(string $method)
    {
        parent::__construct("Method $method not allowed");
    }
}
