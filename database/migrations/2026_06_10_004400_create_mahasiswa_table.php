<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('npm', 15)->primary();
            $table->string('nidn', 10); // Dosen Wali
            $table->string('nama');

            // --- PENAMBAHAN KONSEP NYA KAMPUS ---
            $table->integer('angkatan');        // Menyimpan tahun masuk (contoh: 2023)
            $table->integer('semester_aktif');  // Menyimpan semester saat ini (1 s.d 8)
            $table->enum('kelas', ['A', 'B', 'C']); // Membatasi kelas hanya A, B, atau C

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
