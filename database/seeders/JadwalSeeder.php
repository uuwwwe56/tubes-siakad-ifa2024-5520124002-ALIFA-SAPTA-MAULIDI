<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        Jadwal::query()->delete();

        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamKuliah = [
            ['08:00:00', '09:40:00'],
            ['10:00:00', '11:40:00'],
            ['13:00:00', '14:40:00'],
            ['15:00:00', '16:40:00'],
        ];

        $dosens = Dosen::all();
        $matakuliahs = Matakuliah::all();
        $pilihan_kelas = ['A', 'B', 'C'];

        $global_index = 0;

        foreach ($matakuliahs as $mk) {
            // Setiap 1 mata kuliah, otomatis memiliki 3 cabang jadwal untuk Kelas A, Kelas B, dan Kelas C
            foreach ($pilihan_kelas as $kelas) {

                $dosen = $dosens[$global_index % $dosens->count()];
                $slot = $jamKuliah[$global_index % count($jamKuliah)];
                $hari = $haris[$global_index % count($haris)];

                Jadwal::create([
                    'kode_matakuliah' => $mk->kode_matakuliah,
                    'nidn'            => $dosen->nidn,
                    'kelas'           => $kelas, // Tersimpan Kelas A, B, atau C
                    'hari'            => $hari,
                    'jam_mulai'       => $slot[0],
                    'jam_selesai'     => $slot[1],
                ]);

                $global_index++;
            }
        }
    }
}
