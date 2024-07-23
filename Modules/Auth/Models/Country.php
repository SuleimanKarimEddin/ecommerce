<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Database\Factories\CountryFactory;
use Modules\Base\Models\BaseModel;

class Country extends BaseModel
{
    use HasFactory;

    public function getTableName(): string
    {
        return 'countries';
    }

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'country_name');
    }
}
