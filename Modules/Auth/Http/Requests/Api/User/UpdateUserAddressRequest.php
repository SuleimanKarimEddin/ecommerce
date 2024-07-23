<?php

namespace Modules\Auth\Http\Requests\Api\User;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateUserAddressRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:user_addresses,id',
            'country_name' => 'required|string|exists:countries,name',
            'address_line_1' => 'required|string',
            'address_line_2' => 'required|string',
            'is_default' => 'required|boolean',
        ];
    }
}
