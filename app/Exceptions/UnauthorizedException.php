<?php

namespace App\Exceptions;

use Throwable;

class UnauthorizedException extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Unauthorized', 401, $previous);
    }
}
