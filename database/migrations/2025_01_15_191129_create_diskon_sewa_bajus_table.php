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
        Schema::create('diskon_sewa_bajus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('discount', 15, 2);
            $table->enum('status', ['aktif', 'tidak aktif', 'kadaluarsa'])->default('aktif');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskon_sewa_bajus');
    }
};
