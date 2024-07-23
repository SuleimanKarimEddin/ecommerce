<?php

namespace Modules\Auth\Http\Requests\Dashboard\Admin;

use Modules\Base\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }
}
