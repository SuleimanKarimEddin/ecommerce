<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Database\Factories\UserAddressFactory;
use Modules\Base\Models\BaseModel;

class UserAddress extends BaseModel
{
    use HasFactory;

    public function getTableName()
    {
        return 'user_addresses';
    }

    protected static function newFactory(): UserAddressFactory
    {
        return UserAddressFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'name');
    }
}
