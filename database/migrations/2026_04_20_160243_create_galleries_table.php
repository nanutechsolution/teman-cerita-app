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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Cover utama galeri (Thumbnail yang muncul di Beranda)
            $table->string('cover_image')->nullable();
            $table->string('image_source')->nullable();
            
            // Status & Timestamps
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            
            // Relasi ke tabel users (Penulis & Editor)
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('editor_id')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();

            // Indexing untuk pencarian cepat di beranda
            $table->index(['is_published', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};