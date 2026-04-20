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
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke album induk. Cascade on delete: Jika album dihapus, semua foto di dalamnya ikut terhapus
            $table->foreignId('gallery_id')->constrained('galleries')->cascadeOnDelete();
            
            $table->string('image_path');
            $table->string('caption', 500)->nullable(); // Caption opsional untuk setiap foto spesifik
            $table->integer('sort_order')->default(0); // Untuk mengatur urutan foto saat slider/carousel dibuka
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};