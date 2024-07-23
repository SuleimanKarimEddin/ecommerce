<?php

namespace Modules\Product\Http\Resources\Dashboard\ProductVariation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Http\Resources\Dashboard\ProductVariationImages\GetAllProductVariationImagesResource;

class GetOneProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'disable_out_of_stock' => $this->disable_out_of_stock,
            'main_image' => $this->main_image,
            'product_id' => $this->product_id,
            'images' => $this->images,
        ];
    }
}
