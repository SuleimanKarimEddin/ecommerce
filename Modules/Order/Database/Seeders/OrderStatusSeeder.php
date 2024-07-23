<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Order\Models\OrderStatuses;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatuses::updateOrCreate([
            'status' => 'pending',
        ]);
        OrderStatuses::updateOrCreate([
            'status' => 'processing',
        ]);
        OrderStatuses::updateOrCreate([
            'status' => 'completed',
        ]);
        OrderStatuses::updateOrCreate([
            'status' => 'shipped',
        ]);
        OrderStatuses::updateOrCreate([
            'status' => 'delivered',
        ]);
        OrderStatuses::updateOrCreate([
            'status' => 'returned',
        ]);
        OrderStatuses::updateOrCreate([
            'status' => 'canceled',
        ]);
    }
}
