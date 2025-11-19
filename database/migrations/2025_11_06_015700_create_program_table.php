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
            $table->string('name');
            $table->text('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['draft', 'published', 'archived']);
            $table->string('poster');
            $table->json('penyelenggara');
            $table->enum('tingkat', ['sekolah', 'kecamatan', 'kota', 'provinsi', 'nasional', 'regional', 'internasional'])->nullable();
            $table->json('mata_lomba')->nullable();
            $table->enum('pelaksanaan', ['online', 'offline']);
            $table->string('link_pendaftaran')->nullable();
            $table->string('panduan_lomba')->nullable();

            
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
