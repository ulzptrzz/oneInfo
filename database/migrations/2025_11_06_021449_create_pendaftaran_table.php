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
            $table->date('tanggal_daftar');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->enum('pelaksanaan', ['online', 'offline']);
            $table->string('bukti_pendaftaran');
            $table->string('mata_lomba')->nullable();
            $table->string('syarat_pendaftaran')->nullable();

            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');

            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');

            $table->unique(['siswa_id', 'program_id']);
            $table->timestamps();
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
