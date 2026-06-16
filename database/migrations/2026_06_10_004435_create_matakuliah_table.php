<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->char('kode_matakuliah', 8)->primary();
            $table->string('nama_matakuliah', 100);
            $table->integer('sks');
            $table->integer('semester'); // Tambahkan ini (Untuk memfilter paket semester 1-8)
            $table->enum('status', ['Wajib', 'Pilihan'])->default('Wajib');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matakuliah');
    }
};
