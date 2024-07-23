<?php

namespace Modules\Product\Http\Requests\Dashboard\ProductVariationImages;

use Modules\Base\Http\Requests\BaseRequest;

class CreateProductVariationImagesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'is_main_image' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'variation_id' => 'required|string|exists:product_variations,id',
            'image' => 'required|image',
        ];
    }
}
