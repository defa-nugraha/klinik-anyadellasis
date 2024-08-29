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
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien');
            $table->foreignId('id_dokter');
            $table->foreignId('id_poli');
            $table->date('tanggal_periksa');
            $table->string('no_antrian');
            $table->string('kode_booking');
            $table->string('status');
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
        Schema::dropIfExists('antrian');
    }
};
