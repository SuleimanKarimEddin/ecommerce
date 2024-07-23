<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Database\Factories\UserFactory;
use Modules\Auth\Enums\UserStatusEnum;
use Modules\Base\Models\BaseModel;

class User extends BaseModel
{
    use HasApiTokens;
    use HasFactory;

    protected $casts = [
        'status' => UserStatusEnum::class,
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'code',
    ];

    public function getTableName(): string
    {
        return 'users';
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    public function defaultAddress(): HasOne
    {
        return $this->hasOne(UserAddress::class, 'user_id')->where('is_default', 1);
    }
}
