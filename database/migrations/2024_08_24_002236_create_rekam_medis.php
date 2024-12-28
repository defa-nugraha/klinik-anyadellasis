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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pendaftaran')->nullable();
            $table->foreignId('id_pasien');
            $table->foreignId('id_dokter');
            $table->foreignId('id_poli');
            $table->date('tgl_pemeriksaan');
            $table->string('anamnesa');
            $table->enum('kandungan', [0, 1])->default(0);
            $table->enum('status', ['antrian', 'tindakan', 'di apotek', 'selesai'])->default('antrian');
            $table->string('riwayat_penyakit')->default('-');
            $table->string('riwayat_penyakit_keluarga')->default('-');
            $table->timestamps();

            // relasi ke pasien, dokter, poli
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('dokter')->onDelete('cascade');
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
