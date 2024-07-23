<?php

namespace Modules\Product\Http\Requests\Dashboard\Product;

use Modules\Base\Http\Requests\BaseRequest;

class CreateProductRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'category_id' => 'required|numeric|exists:categories,id',
        ];
    }
}
