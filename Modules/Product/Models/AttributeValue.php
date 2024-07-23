<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Models\BaseModel;
use Modules\Product\Database\Factories\AttributeValueFactory;

class AttributeValue extends BaseModel
{
    use HasFactory;

    protected static function newFactory(): AttributeValueFactory
    {
        return AttributeValueFactory::new();
    }

    public function getTableName(): string
    {
        return 'attribute_values';
    }

    public function attributes()
    {
        return $this->belongsTo(Attribute::class, 'name');
    }
}
