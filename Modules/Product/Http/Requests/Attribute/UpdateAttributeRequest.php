<?php

namespace Modules\Product\Http\Requests\Attribute;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateAttributeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|unique:attributes,name,'.$this->id.',name',
        ];
    }
}
