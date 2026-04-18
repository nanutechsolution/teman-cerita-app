<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Contoh: Kontributor Tulisan
            $table->string('slug')->unique();
            $table->string('type'); // Full-time, Freelance, Remote, Internship
            $table->string('location')->nullable(); // Kupang, Flores, dsb
            $table->text('description'); // Ringkasan singkat untuk kartu
            $table->string('apply_link')->nullable(); // Link pendaftaran atau email
            $table->boolean('is_featured')->default(false); // Untuk desain highlight (kotak gelap)
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};