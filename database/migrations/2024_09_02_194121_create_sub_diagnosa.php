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
        Schema::create('sub_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_diagnosa');
            $table->foreignId('id_icd');
            $table->timestamps();

            // relasi ke icd dan diagnosa
            $table->foreign('id_icd')->references('id')->on('icd')->onDelete('cascade');
            $table->foreign('id_diagnosa')->references('id')->on('diagnosa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_diagnosa');
    }
};
