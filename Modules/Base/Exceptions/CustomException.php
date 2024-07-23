<?php

namespace Modules\Base\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomException extends Exception
{
    public function __construct(protected $message = '', protected $code = 500) {}

    public function render(Request $request): Response
    {
        return response([
            'code' => $this->code,
            'message' => $this->message,
        ], 499);
    }
}
