<?php

namespace Modules\Product\Http\Resources\Dashboard\ProductVariationImages;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllProductVariationImagesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

    }
}
