<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('profession');
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            
            // Media Sosial
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            
            $table->timestamps();
        });

        // Pivot Table: Karena satu Episode bisa punya banyak Narasumber (dan sebaliknya)
        Schema::create('episode_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->constrained()->onDelete('cascade');
            $table->foreignId('speaker_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episode_speaker');
        Schema::dropIfExists('speakers');
    }
};