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
        Schema::table('lama_uts', function (Blueprint $table) {
            $table->integer('lama_kerja')->nullable();
            $table->integer('menit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lama_uts', function (Blueprint $table) {
            $table->dropColumn('lama_kerja');
            $table->dropColumn('menit');
        });
    }
};
