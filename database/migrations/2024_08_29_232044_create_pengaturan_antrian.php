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
        Schema::create('pengaturan_antrian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_poli');
            $table->integer('max_antrian');
            $table->string('deskripsi');
            $table->timestamps();

            // relasi ke poli
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_antrian');
    }
};
