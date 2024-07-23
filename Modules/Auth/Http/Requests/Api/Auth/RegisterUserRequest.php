<?php

namespace Modules\Auth\Http\Requests\Api\Auth;

use Modules\Base\Http\Requests\BaseRequest;

class RegisterUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:3|max:30',
            'last_name' => 'required|string|min:3|max:30',
            'phone_number' => 'required|string|max:16|unique:users,phone_number',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ];
    }
}
