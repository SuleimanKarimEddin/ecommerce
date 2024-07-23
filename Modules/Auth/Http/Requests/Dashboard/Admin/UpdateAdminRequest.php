<?php

namespace Modules\Auth\Http\Requests\Dashboard\Admin;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateAdminRequest extends BaseRequest
{
    public function rules()
    {
        return [
            // 'id' => 'required|exists:admins,id',
            'first_name' => 'string|max:100',
            'last_name' => 'string|max:100',
            'email' => 'string|email|exists:admins,email',
        ];
    }
}
