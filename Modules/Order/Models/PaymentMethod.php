<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Models\BaseModel;
use Modules\Order\Database\Factories\PaymentMethodFactory;
use Modules\Order\Enums\PaymentMethodEnum;

class PaymentMethod extends BaseModel
{
    use HasFactory;

    public function getTableName(): string
    {
        return 'payment_methods';
    }

    protected static function newFactory(): PaymentMethodFactory
    {
        return PaymentMethodFactory::new();
    }

    protected $casts = [
        'method' => PaymentMethodEnum::class,
    ];
}
