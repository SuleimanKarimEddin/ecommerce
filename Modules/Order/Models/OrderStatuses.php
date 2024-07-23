<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Models\BaseModel;
use Modules\Order\Database\Factories\OrderStatusesFactory;
use Modules\Order\Enums\OrderStatusEnum;

class OrderStatuses extends BaseModel
{
    use HasFactory;

    public function getTableName(): string
    {
        return 'order_statuses';
    }

    protected static function newFactory(): OrderStatusesFactory
    {
        return OrderStatusesFactory::new();
    }

    public function orders()
    {
        return $this->hasOne(Orders::class);
    }

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];
}
