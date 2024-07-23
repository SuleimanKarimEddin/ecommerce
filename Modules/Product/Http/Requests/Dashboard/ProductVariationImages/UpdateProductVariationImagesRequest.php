<?php

namespace Modules\Product\Http\Requests\Dashboard\ProductVariationImages;

use Modules\Base\Http\Requests\BaseRequest;

class UpdateProductVariationImagesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'is_main_image' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'image' => 'sometimes|image',
        ];
    }
}
