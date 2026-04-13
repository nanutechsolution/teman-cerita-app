<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('redaction_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // Contoh: Pemimpin Redaksi, Reporter, dll.
            /**
             * Grouping untuk memisahkan kotak-kotak di UI:
             * 'pimpinan', 'editorial', 'it_sosmed'
             */
            $table->string('group')->default('editorial'); 
            $table->string('photo')->nullable();
            $table->integer('sort_order')->default(0); // Untuk urutan tampilan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redaction_members');
    }
};