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
        Schema::create('tindakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rekam_medis');
            $table->string('deskripsi')->nullable();
            $table->string('file_tindakan')->nullable();
            $table->timestamps();

            // relasi ke rekam medis
            $table->foreign('id_rekam_medis')->references('id')->on('rekam_medis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan');
    }
};
