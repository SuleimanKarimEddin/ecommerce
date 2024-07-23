<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariation;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::create([
            'name' => 'test',
            'short_description' => 'test',

        ]);

        ProductVariation::create([
            'price' => 10,
            'product_id' => $product->id,
            'main_image' => 'test',
        ]);

    }
}
