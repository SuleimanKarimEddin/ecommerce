<?php

namespace Modules\Auth\Http\Requests\Api\Auth;

use Modules\Base\Http\Requests\BaseRequest;

class VerifyCodeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required|string|exists:users,phone_number',
            'code' => 'required|string',
        ];
    }
}
