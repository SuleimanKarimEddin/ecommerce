<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Models\BaseModel;
use Modules\Product\Database\Factories\AttributeFactory;

class Attribute extends BaseModel
{
    use HasFactory;

    protected static function newFactory(): AttributeFactory
    {
        return AttributeFactory::new();
    }

    public function getTableName(): string
    {
        return 'attributes';
    }

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'value');
    }

    public function getKey(): string
    {
        return 'name';
    }
}
