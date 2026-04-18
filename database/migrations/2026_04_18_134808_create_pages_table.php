<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul halaman, misal: "Kebijakan Privasi"
            $table->string('slug')->unique(); // URL ramah, misal: "kebijakan-privasi"
            $table->longText('content'); // Isi halaman menggunakan format Rich Text / HTML
            $table->boolean('is_active')->default(true); // Status tampil/sembunyi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};