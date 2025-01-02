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
        Schema::create('image_sewa_bajus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_baju_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->decimal('size', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_sewa_bajus');
    }
};
