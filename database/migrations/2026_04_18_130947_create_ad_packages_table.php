<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ad_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Display Ads, Video Native
            $table->text('description'); // Deskripsi paket iklan
            $table->string('price_text'); // Contoh: Mulai dari Rp 500rb/bln
            $table->text('icon')->nullable(); // Untuk menyimpan kode SVG secara langsung
            $table->boolean('is_featured')->default(false); // True jika ingin desain kotak warna gelap/berbeda
            $table->integer('sort_order')->default(0); // Urutan tampil di frontend
            $table->boolean('is_active')->default(true); // Status aktif/non-aktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ad_packages');
    }
};