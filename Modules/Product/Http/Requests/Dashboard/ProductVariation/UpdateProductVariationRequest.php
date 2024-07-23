<?php

namespace Modules\Product\Http\Requests\Dashboard\ProductVariation;

use Modules\Base\Http\Requests\BaseRequest;
// use Modules\Product\Http\Requests\Dashboard\StringOrFile;

class UpdateProductVariationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'disable_out_of_stock' => 'nullable|boolean',
            'main_image' => 'nullable|image',
            'product_id' => 'nullable|numeric|exists:products,id',
            'images' => 'nullable|array',
            'images.*' => ['nullable', new StringOrFile],
        ];
    }
}
