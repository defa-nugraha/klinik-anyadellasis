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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreignId('id_poli');
            $table->string('spesialisa')->nullable();
            $table->timestamps();

            // relasi ke poli dan users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_polis')->references('id')->on('poli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
