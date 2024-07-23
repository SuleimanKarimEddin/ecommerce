<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Models\User;
use Modules\Auth\Models\UserAddress;
use Modules\Base\Models\BaseModel;
use Modules\Order\Database\Factories\OrdersFactory;

class Orders extends BaseModel
{
    use HasFactory;

    public function getTableName(): string
    {
        return 'orders';
    }

    protected static function newFactory(): OrdersFactory
    {
        return OrdersFactory::new();
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'id');
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatuses::class, 'if');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
