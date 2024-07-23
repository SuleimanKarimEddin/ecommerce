<?php

namespace Modules\Auth\Exceptions;

use Exception;

class InvalidStatusException extends Exception
{
    public function __construct($message = 'Invalid status name', $code = 422)
    {
        parent::__construct($message, $code);
    }
}
