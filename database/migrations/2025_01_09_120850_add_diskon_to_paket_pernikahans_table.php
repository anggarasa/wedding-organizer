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
        Schema::table('paket_pernikahans', function (Blueprint $table) {
            $table->foreignId('diskon_paket_pernikahan_id')->nullable()->constrained('diskon_paket_pernikahans')->onDelete('cascade');
            $table->decimal('discount', 15,2)->nullable()->after('price');
            $table->decimal('final_price', 15,2)->nullable()->after('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_pernikahans', function (Blueprint $table) {
            $table->dropColumn('diskon_paket_pernikahan_id');
            $table->dropColumn('discount');
            $table->dropColumn('final_price');
        });
    }
};
