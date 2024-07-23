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
        Schema::create('product_attribute_values', function (Blueprint $table) {

            $table->id();
            $table->foreignId('variation_id')->nullable()->constrained('product_variations')->noActionOnDelete();

            $table->string('attribute_name', 100)->nullable();
            $table->foreign('attribute_name')->references('name')->on('attributes')->cascadeOnDelete();

            $table->string('attribute_value', 100)->nullable();
            $table->foreign('attribute_value')->references('value')->on('attribute_values')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_values');
    }
};
