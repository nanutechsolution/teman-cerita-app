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
        Schema::table('post_tag', function (Blueprint $table) {
            // Gunakan nama constraint asli sebelum tabel di-rename
            $table->dropForeign('episode_tag_episode_id_foreign');
            $table->renameColumn('episode_id', 'post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::table('post_speaker', function (Blueprint $table) {
            // Gunakan nama constraint asli sebelum tabel di-rename
            $table->dropForeign('episode_speaker_episode_id_foreign');
            $table->renameColumn('episode_id', 'post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
};
