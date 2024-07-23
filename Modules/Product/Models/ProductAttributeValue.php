<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Models\BaseModel;
use Modules\Product\Database\Factories\ProductAttributeValueFactory;

class ProductAttributeValue extends BaseModel
{
    use HasFactory;

    protected static function newFactory(): ProductAttributeValueFactory
    {
        return ProductAttributeValueFactory::new();
    }

    public function getTableName(): string
    {

        return 'product_attribute_values';
    }
}
