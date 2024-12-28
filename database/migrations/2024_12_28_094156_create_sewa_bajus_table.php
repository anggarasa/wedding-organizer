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
        Schema::create('sewa_bajus', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->decimal('price', 15, 2);
            $table->enum('status', ['Tersedia', 'Disewa', 'Maintenance']);
            $table->enum('ukuran', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->enum('category', ['Kebaya Akad', 'Kebaya Resepsi', 'Gaun Pengantin Modern', 'Jas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewa_bajus');
    }
};
