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
        Schema::create('tugasjawabs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('materi_id');
            $table->text('text')->nullable();
            $table->string('gambar')->nullable();
            $table->text('pdf')->nullable();
            $table->text('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugasjawabs');
    }
};
