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
        Schema::create('obat_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rekam_medis');
            $table->foreignId('id_obat');
            $table->foreignId('id_pasien');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // relasi ke rekam medis, obat, dan pasien
            $table->foreign('id_rekam_medis')->references('id')->on('rekam_medis')->onDelete('cascade');
            $table->foreign('id_obat')->references('id')->on('obat')->onDelete('cascade');
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat_keluar');
    }
};
