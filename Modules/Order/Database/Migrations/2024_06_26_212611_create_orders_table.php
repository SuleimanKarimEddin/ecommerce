<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('address_id')->constrained('user_addresses')->cascadeOnDelete();
            $table->string('order_status');
            $table->foreign('order_status')->references('status')->on('order_statuses')->cascadeOnDelete();
            $table->string('payment_method');
            $table->foreign('payment_method')->references('method')->on('payment_methods')->cascadeOnDelete();
            $table->string('payment_id')->nullable();
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
