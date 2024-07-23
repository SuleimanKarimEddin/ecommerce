<?php

namespace Modules\Product\Http\Requests\Dashboard\Product;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateProductRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'short_description' => 'sometimes|string',
            'is_active' => 'sometimes|boolean',
            'category_id' => 'sometimes|required|numeric|exists:categories,id',

        ];
    }
}
