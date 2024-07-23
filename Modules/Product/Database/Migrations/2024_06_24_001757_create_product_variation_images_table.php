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
        Schema::create('product_variation_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->nullable()->constrained('product_variations')->noActionOnDelete();
            $table->string('image');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_main_image')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variation_images');
    }
};
