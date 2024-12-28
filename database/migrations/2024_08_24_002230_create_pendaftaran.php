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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien');
            $table->foreignId('id_dokter');
            $table->foreignId('id_poli');
            $table->date('tgl_pendaftaran');
            $table->string('nomor_antrian');
            $table->enum('status', ['approved', 'rejected', 'pending', 'waiting', 'cancel'])->default('waiting');
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
        Schema::dropIfExists('pendaftaran');
    }
};
