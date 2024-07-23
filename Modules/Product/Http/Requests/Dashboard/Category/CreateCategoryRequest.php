<?php

namespace Modules\Product\Http\Requests\Dashboard\Category;

use Modules\Base\Http\Requests\BaseRequest;

class CreateCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'is_active' => 'nullable|boolean',
            'parent_id' => 'nullable|string|exists:categories,id',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff|max:2048',
        ];
    }
}
