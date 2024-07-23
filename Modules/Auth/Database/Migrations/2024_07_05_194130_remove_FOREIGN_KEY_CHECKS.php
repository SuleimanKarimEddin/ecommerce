<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS=0;');

    }

    public function down(): void
    {
        DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS=1;');

    }
};
