<?php

namespace Modules\Product\Http\Resources\Dashboard\ProductVariationImages;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetAllProductVariationImagesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}