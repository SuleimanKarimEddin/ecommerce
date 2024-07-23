<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Models\BaseModel;
use Modules\Product\Database\Factories\ProductVariationImageFactory;

class ProductVariationImage extends BaseModel
{
    use HasFactory;

    protected static function newFactory(): ProductVariationImageFactory
    {
        return ProductVariationImageFactory::new();
    }

    public function getTableName(): string
    {

        return 'product_variation_images';
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
