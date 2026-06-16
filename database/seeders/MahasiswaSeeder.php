<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $daftar_nidn = Dosen::pluck('nidn')->toArray();

        if (empty($daftar_nidn)) {
            $daftar_nidn = ['0401018901'];
        }

        // Definisi 4 Angkatan Aktif di Kampus untuk Tahun Berjalan 2026
        $skema_angkatan = [
            ['tahun' => 2025, 'semester' => 1], // Angkatan ke-4 (Maba)
            ['tahun' => 2024, 'semester' => 3], // Angkatan ke-3
            ['tahun' => 2023, 'semester' => 5], // Angkatan ke-2
            ['tahun' => 2022, 'semester' => 7], // Angkatan ke-1 (Senior)
        ];

        $pilihan_kelas = ['A', 'B', 'C'];
        $counter_npm = 1;

        // Loop membuat data mahasiswa agar terbagi rata di setiap angkatan dan kelas
        foreach ($skema_angkatan as $skema) {
            foreach ($pilihan_kelas as $kls) {

                // Buat 4 mahasiswa per kelas di setiap angkatan (Total sekitar 48 mahasiswa)
                for ($m = 0; $m < 4; $m++) {

                    // Generate NPM Realistis: 2 digit tahun + kode prodi (534) + nomor urut rapi
                    // Contoh: 23534001 (Angkatan 2023, Prodi 534, Urutan 001)
                    $dua_digit_tahun = substr($skema['tahun'], -2);
                    $npm = $dua_digit_tahun . '534' . sprintf('%03d', $counter_npm);

                    // Buat akun login user
                    $user = User::create([
                        'username' => $npm,
                        'password' => Hash::make('mahasiswa123'),
                        'role' => 'mahasiswa'
                    ]);

                    // Buat data profil mahasiswa
                    Mahasiswa::create([
                        'npm' => $npm,
                        'nidn' => $faker->randomElement($daftar_nidn),
                        'nama' => $faker->name,
                        'angkatan' => $skema['tahun'],
                        'semester_aktif' => $skema['semester'],
                        'kelas' => $kls, // Kelas A, B, atau C
                        'user_id' => $user->id
                    ]);

                    $counter_npm++;
                }
            }
        }

        // =============================================================
        // MAHASISWA KHUSUS PENGUJI (Icha Yuniar - Angkatan 2024 / Sem 3 / Kelas A)
        // =============================================================
        $user_icha = User::create([
            'username' => '53413002', // Tetap mempertahankan NPM lama Anda agar tidak perlu ganti akun
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa'
        ]);

        Mahasiswa::create([
            'npm' => '53413002',
            'nidn' => $faker->randomElement($daftar_nidn),
            'nama' => 'Icha Yuniar',
            'angkatan' => 2024,
            'semester_aktif' => 3,
            'kelas' => 'A',
            'user_id' => $user_icha->id
        ]);
    }
}
