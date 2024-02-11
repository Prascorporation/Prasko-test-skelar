<?php

namespace App\Enums;

enum ResponseStatusCode: int
{
    case OK = 200;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case NOT_FOUND = 404;
    case NOT_ALLOWED = 405;
    case INTERNAL_SERVER_ERROR = 500;
}
