<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Menambah kolom baru setelah kolom 'img'
            $table->string('tags')->nullable()->after('img');

            // Mengubah kolom yang sudah ada (Misal: link jadi nullable)
            // Catatan: Perlu install package 'doctrine/dbal' jika versi Laravel lama
            $table->string('link')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Batalkan perubahan jika migrasi di-rollback
            $table->dropColumn('tags');
            $table->string('link')->nullable(false)->change();
        });
    }
};
