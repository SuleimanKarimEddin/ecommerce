<?php

namespace Modules\Auth\Http\Requests\Dashboard\Country;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateCountryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|unique:countries,name,'.$this->id.',name',
        ];
    }
}
