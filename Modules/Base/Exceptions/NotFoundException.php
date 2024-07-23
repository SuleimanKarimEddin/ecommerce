<?php

namespace Modules\Base\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotFoundException extends Exception
{
    public function render(Request $request): Response
    {
        return response([
            'code' => 404,
            'message' => 'Not Found',
        ], 404);
    }
}
