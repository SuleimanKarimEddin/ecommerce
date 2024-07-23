<?php

namespace Modules\Auth\Http\Requests\Api\UserAuth;

use Modules\Base\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required|exists:users,phone_number',
            'password' => 'required|string',
        ];
    }
}
