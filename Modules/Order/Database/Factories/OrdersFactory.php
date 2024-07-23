<?php

namespace Modules\Order\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Database\Factories\UserFactory;
use Modules\Auth\Models\UserAddress;

class OrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Order\Models\Orders::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => UserFactory::class,
            'address_id' => UserAddress::class,
            'order_status_id' => OrderStatusesFactory::class,
            'payment_method' => PaymentMethodFactory::class,
            'total' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
