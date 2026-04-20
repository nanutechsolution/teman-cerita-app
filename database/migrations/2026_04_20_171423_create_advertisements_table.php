<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk tabel advertisements.
     */
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            
            // Informasi Utama Iklan
            $table->string('title'); 
            $table->string('image_path'); 
            $table->string('link_url')->nullable(); 
            
            // Lokasi Penempatan (e.g., 'home_middle', 'sidebar', 'header_top')
            $table->string('position'); 
            
            // Statistik & Pelacakan
            $table->unsignedBigInteger('clicks')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            
            // Status & Penjadwalan
            $table->boolean('is_active')->default(true);
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            
            $table->timestamps();

            // Optimasi Database: Indexing untuk query yang sering dilakukan
            $table->index(['position', 'is_active', 'expired_at']);
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};