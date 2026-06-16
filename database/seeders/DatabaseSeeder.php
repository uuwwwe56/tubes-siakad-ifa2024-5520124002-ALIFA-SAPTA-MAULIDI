<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,       // 1. Buat Akun Admin
            DosenSeeder::class,      // 2. Buat Data Dosen & Akun Dosen Wali
            MatakuliahSeeder::class, // 3. Buat Paket Kurikulum Lengkap Sem 1-8
            MahasiswaSeeder::class,  // 4. Buat Mahasiswa (Termasuk Lalan & Icha Yuniar)
            JadwalSeeder::class,
        ]);
    }
}
