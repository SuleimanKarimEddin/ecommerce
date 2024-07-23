<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Base\Models\BaseModel;
use Modules\Order\Database\Factories\OrderItemsFactory;
use Modules\Product\Models\ProductVariation;

class OrderItems extends BaseModel
{
    public function getTableName(): string
    {
        return 'order_items';
    }

    protected static function newFactory(): OrderItemsFactory
    {
        return OrderItemsFactory::new();
    }

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function productVariation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }
}
