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
        // Mengubah nama tabel utama
        Schema::rename('episodes', 'posts');
        Schema::rename('episode_tag', 'post_tag');
        Schema::rename('episode_speaker', 'post_speaker');
    }

    public function down(): void
    {
        // Rollback jika terjadi kesalahan
        Schema::rename('posts', 'episodes');
        Schema::rename('post_tag', 'episode_tag');
        Schema::rename('post_speaker', 'episode_speaker');
    }
};
