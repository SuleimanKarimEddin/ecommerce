<?php

namespace Modules\Product\Http\Requests\AttributeValues;

use Modules\Base\Http\Requests\BaseRequest;

class CreateAttributeValuesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'value' => 'required|string|unique:attribute_values,value',
            'attribute_name' => 'required|string|exists:attributes,name',
        ];
    }
}
