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
        Schema::table('posts', function (Blueprint $table) {
            // Menambah composite index untuk mempercepat query portal berita
            $table->index(['is_published', 'is_headline', 'published_at'], 'idx_published_headline');
            $table->index(['is_published', 'is_breaking', 'published_at'], 'idx_published_breaking');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('idx_published_headline');
            $table->dropIndex('idx_published_breaking');
        });
    }
};
