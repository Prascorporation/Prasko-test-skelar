<?php

namespace App\Middleware;

abstract class AbstractMiddleware
{
    abstract public function handle();
}
