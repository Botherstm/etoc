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
        Schema::create('uts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('soal')->unique();
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->string('kunci');
            $table->string('gambar')->nullable();
            $table->string('video')->nullable();
            $table->timestamp('waktu')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz');
    }
};
