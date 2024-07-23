<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Models\BaseModel;
use Modules\Product\Database\Factories\ProductFactory;

class Product extends BaseModel
{
    use HasFactory;

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function getTableName(): string
    {

        return 'products';
    }
}
