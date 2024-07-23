<?php

namespace Modules\Auth\Http\Requests\Dashboard\Addresses;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateAddressesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'country_name' => 'required|string|exists:countries,name',
            'address_line_1' => 'required|string',
            'address_line_2' => 'required|string',
            'is_default' => 'required|boolean', 
            'user_id' => 'required|exists:users,id',        ];
    }
}