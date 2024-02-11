<?php

namespace App\Exceptions;

use Exception;

class PageNotFoundException extends Exception
{
    public function __construct(string $uri)
    {
        parent::__construct("Page with uri $uri not found");
    }
}
