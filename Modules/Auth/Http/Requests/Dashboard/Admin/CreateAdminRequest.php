<?php

namespace Modules\Auth\Http\Requests\Dashboard\Admin;

use Modules\Base\Http\Requests\BaseRequest;

class CreateAdminRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string',
        ];
    }
}
