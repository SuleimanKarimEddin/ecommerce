<?php

namespace Modules\Product\Http\Requests\Attribute;

use Modules\Base\Http\Requests\BaseRequest;

class CreateAttributeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|unique:attributes,name',
        ];
    }
}
