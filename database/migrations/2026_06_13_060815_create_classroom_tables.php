<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Pertemuan / Topik Kuliah
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade');
            $table->integer('pertemuan_ke');
            $table->string('judul_topik');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_absensi_active')->default(0);
            $table->timestamps();
        });

        // 2. Tabel Materi Kuliah
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuans')->onDelete('cascade');
            $table->string('judul_materi');
            $table->text('konten_teks')->nullable();
            $table->string('file_path')->nullable(); // Untuk PDF/PPT Module
            $table->timestamps();
        });

        // 3. Tabel Tugas Kuliah
        Schema::create('tugases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuans')->onDelete('cascade');
            $table->string('judul_tugas');
            $table->text('instruksi');
            $table->string('file_instruksi')->nullable();
            $table->dateTime('deadline');
            $table->timestamps();
        });

        // 4. Tabel Pengumpulan Tugas Mahasiswa (Submissions)
        Schema::create('tugas_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugases')->onDelete('cascade');
            $table->string('npm', 15);
            $table->string('file_jawaban');
            $table->text('catatan_mahasiswa')->nullable();
            $table->integer('nilai')->nullable();
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();

            $table->foreign('npm')->references('npm')->on('mahasiswa')->onDelete('cascade');
        });

        // Pada tabel absensis, kita buat default atau biarkan diisi oleh mahasiswa
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuans')->onDelete('cascade');
            $table->string('npm', 15);
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alfa']);
            $table->timestamps();

            $table->foreign('npm')->references('npm')->on('mahasiswa')->onDelete('cascade');
            // Memastikan satu mahasiswa hanya bisa absen 1 kali di pertemuan tersebut
            $table->unique(['pertemuan_id', 'npm']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
        Schema::dropIfExists('tugas_submissions');
        Schema::dropIfExists('tugases');
        Schema::dropIfExists('materis');
        Schema::dropIfExists('pertemuans');
    }
};
