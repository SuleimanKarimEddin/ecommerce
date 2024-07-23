<?php

namespace Modules\Auth\Http\Requests\Dashboard\Addresses;

use Modules\Base\Http\Requests\BaseRequest;

class GetAllAddressesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            "user_id" => "required|exists:users,id",
            "page" => "integer",
            "per_page" => "integer"
        ];
    }
}