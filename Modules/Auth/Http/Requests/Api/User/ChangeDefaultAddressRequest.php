<?php

namespace Modules\Auth\Http\Requests\Api\User;

use Modules\Base\Http\Requests\BaseRequest;

class ChangeDefaultAddressRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'address_id' => 'required|exists:user_addresses,id',
        ];
    }
}
