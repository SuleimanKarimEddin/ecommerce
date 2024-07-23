<?php

namespace Modules\Auth\Http\Requests\Dashboard\User;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'string|max:100',
            'phone_number' => 'string|max:100',
            'password' => 'string|min:6',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'string',
        ];
    }
}
