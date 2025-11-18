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
        Schema::create('kategori_program', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->string('deskripsi');
            $table->timestamps();
        });

        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('deskripsi_singkat');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['draft', 'published', 'archived']);
            $table->string('poster');
            $table->string('penyelenggara');
            $table->enum('tingkat', ['nasional', 'provinsi', 'kota']);
            $table->string('mata_lomba');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_program_id');
            $table->foreign('kategori_program_id')->references('id')->on('kategori_program')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
        Schema::dropIfExists('kategori_program');
    }
};
