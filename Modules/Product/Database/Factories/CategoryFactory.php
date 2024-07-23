<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Product\Models\Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
