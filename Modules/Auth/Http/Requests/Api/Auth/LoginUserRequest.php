<?php

namespace Modules\Auth\Http\Requests\Api\Auth;

use Modules\Base\Http\Requests\BaseRequest;

class LoginUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required|string|exists:users,phone_number',
            'password' => 'required|string|min:6|max:30',
        ];
    }
}
