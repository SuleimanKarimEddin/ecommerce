<?php

namespace Modules\Product\Http\Requests\Dashboard\Category;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff|max:2048',
        ];
    }
}
