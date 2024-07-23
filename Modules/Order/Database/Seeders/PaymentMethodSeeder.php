<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Order\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::updateOrCreate([
            'method' => 'online',
        ]);
        PaymentMethod::updateOrCreate([
            'method' => 'cash',
        ]);
    }
}
