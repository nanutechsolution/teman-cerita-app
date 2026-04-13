<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update Tabel Episodes (Artikel Utama)
        Schema::table('episodes', function (Blueprint $table) {
            // Metrik & Tipe
            $table->unsignedBigInteger('views')->default(0)->after('is_published');
            $table->enum('type', ['video', 'short', 'article'])->default('article')->after('title');
            $table->string('duration', 10)->nullable()->after('type'); // Untuk konten video

            // Jurnalisme & Hak Cipta Gambar
            $table->text('excerpt')->nullable()->after('content');
            $table->string('image_caption')->nullable()->after('img');
            $table->string('image_source')->nullable()->after('image_caption');

            // Flag Tampilan Frontend
            $table->boolean('is_headline')->default(0)->after('is_published');
            $table->boolean('is_breaking')->default(0)->after('is_headline');

            // Author & Editor
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('editor_id')->nullable()->constrained('users')->nullOnDelete();
        });

        // 2. Buat Tabel Tags
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 3. Buat Tabel Pivot (Relasi Many-to-Many Artikel dan Tag)
        Schema::create('episode_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->constrained('episodes')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episode_tag');
        Schema::dropIfExists('tags');

        Schema::table('episodes', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['editor_id']);
            $table->dropColumn([
                'views',
                'type',
                'duration',
                'excerpt',
                'image_caption',
                'image_source',
                'is_headline',
                'is_breaking',
                'author_id',
                'editor_id'
            ]);
        });
    }
};
