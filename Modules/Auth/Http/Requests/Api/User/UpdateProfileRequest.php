<?php

namespace Modules\Auth\Http\Requests\Api\User;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'country_name' => 'required|string|max:255|exists:countries,name',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'required|string|max:255',
        ];
    }
}
