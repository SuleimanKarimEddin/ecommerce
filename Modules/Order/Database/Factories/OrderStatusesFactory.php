<?php

namespace Modules\Order\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Database\Factories\AdminFactory;
use Modules\Order\Enums\OrderStatusEnum;

class OrderStatusesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Order\Models\OrderStatuses::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(OrderStatusEnum::cases())->value,
            'created_by' => AdminFactory::class,
            'updated_by' => AdminFactory::class,
        ];
    }
}
