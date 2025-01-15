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
        Schema::table('sewa_bajus', function (Blueprint $table) {
            $table->foreignId('diskon_sewa_baju_id')->nullable()->constrained('diskon_sewa_bajus')->onDelete('set null');
            $table->decimal('discount', 15,2)->nullable()->after('price');
            $table->decimal('final_price', 15,2)->nullable()->after('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewa_bajus', function (Blueprint $table) {
            //
        });
    }
};
