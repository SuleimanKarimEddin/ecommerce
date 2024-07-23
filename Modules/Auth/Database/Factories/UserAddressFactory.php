<?php

namespace Modules\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Auth\Models\UserAddress::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => UserFactory::class,
            'country_name' => CountryFactory::class,
            'address_line_1' => $this->faker->address(),
            'address_line_2' => $this->faker->address(),
        ];
    }
}
