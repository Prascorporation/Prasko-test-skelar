<?php

namespace App\Enums;

enum ResponseStatusCode: int
{
    case OK = 200;
    case UNAUTHORIZED = 401;
    case NOT_FOUND = 404;
    case NOT_ALLOWED = 405;
}
