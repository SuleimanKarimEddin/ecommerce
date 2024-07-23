<?php

namespace Modules\Product\Http\Requests\Dashboard\ProductVariation;

use Modules\Base\Http\Requests\BaseRequest;

class CreateProductVariationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'disable_out_of_stock' => 'required|boolean',
            'main_image' => 'required|image',
            'product_id' => 'required|numeric|exists:products,id',
            'images' => 'nullable|array',
        ];
    }
}
