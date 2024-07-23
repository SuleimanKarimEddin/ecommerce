<?php

namespace Modules\Product\Http\Requests\AttributeValues;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateAttributeValuesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'value' => 'required|string|unique:attribute_values,value,'.$this->id.',value',
            'attribute_name' => 'required|string|exists:attributes,name',

        ];
    }
}
