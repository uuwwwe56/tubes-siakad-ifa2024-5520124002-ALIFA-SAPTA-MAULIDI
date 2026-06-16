<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id(); // int(10) unsigned auto increment
            $table->char('kode_matakuliah', 8); // Disesuaikan panjangnya dengan tabel matakuliah (char 8)
            $table->char('nidn', 10);
            $table->char('kelas', 1);
            $table->string('hari', 10);
            
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            // Foreign Key Constraints
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliah')->onDelete('cascade');
            $table->foreign('nidn')->references('nidn')->on('dosen')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
