<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Models\BaseModel;
use Modules\Product\Database\Factories\ProductVariationFactory;

class ProductVariation extends BaseModel
{
    use HasFactory;

    protected static function newFactory(): ProductVariationFactory
    {
        return ProductVariationFactory::new();
    }

    public function getTableName(): string
    {

        return 'product_variations';
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductVariationImage::class, 'variation_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
