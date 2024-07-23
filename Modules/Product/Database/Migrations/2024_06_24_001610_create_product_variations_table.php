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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->string('main_image');
            $table->decimal('quantity')->default(0);

            $table->boolean('disable_out_of_stock')->default(false);
            $table->foreignId('product_id')->constrained('products')->noActionOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('admins')->noActionOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->noActionOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
