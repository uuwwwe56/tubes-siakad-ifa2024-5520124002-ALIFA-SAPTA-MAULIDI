<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $kurikulum = [
            // --- SEMESTER 1 (Total 22 SKS) --- [cite: 82]
            ['kode' => 'IF1101', 'nama' => 'Pendidikan Agama', 'sks' => 2, 'semester' => 1, 'status' => 'Wajib'],
            ['kode' => 'IF1102', 'nama' => 'Pancasila', 'sks' => 2, 'semester' => 1, 'status' => 'Wajib'],
            ['kode' => 'IF1103', 'nama' => 'Bahasa Indonesia', 'sks' => 2, 'semester' => 1, 'status' => 'Wajib'],
            ['kode' => 'IF1104', 'nama' => 'Pengantar Teknologi Informasi', 'sks' => 3, 'semester' => 1, 'status' => 'Wajib'],
            ['kode' => 'IF1105', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 1, 'status' => 'Wajib'],
            ['kode' => 'IF1106', 'nama' => 'Matematika Dasar', 'sks' => 3, 'semester' => 1, 'status' => 'Wajib'],
            ['kode' => 'IF1107', 'nama' => 'Logika Informatika', 'sks' => 3, 'semester' => 1, 'status' => 'Wajib'],
            ['kode' => 'IF1108', 'nama' => 'Bahasa Inggris', 'sks' => 3, 'semester' => 1, 'status' => 'Wajib'],

            // --- SEMESTER 2 (Total 21 SKS) --- [cite: 83]
            ['kode' => 'IF1201', 'nama' => 'Kewarganegaraan', 'sks' => 2, 'semester' => 2, 'status' => 'Wajib'],
            ['kode' => 'IF1202', 'nama' => 'Struktur Data', 'sks' => 4, 'semester' => 2, 'status' => 'Wajib'],
            ['kode' => 'IF1203', 'nama' => 'Sistem Digital', 'sks' => 3, 'semester' => 2, 'status' => 'Wajib'],
            ['kode' => 'IF1204', 'nama' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 2, 'status' => 'Wajib'],
            ['kode' => 'IF1205', 'nama' => 'Basis Data Dasar', 'sks' => 3, 'semester' => 2, 'status' => 'Wajib'],
            ['kode' => 'IF1206', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 4, 'semester' => 2, 'status' => 'Wajib'],
            ['kode' => 'IF1207', 'nama' => 'Statistik Dasar', 'sks' => 2, 'semester' => 2, 'status' => 'Wajib'],

            // --- SEMESTER 3 (Total 23 SKS) --- [cite: 85]
            ['kode' => 'IF2301', 'nama' => 'Basis Data Lanjut', 'sks' => 3, 'semester' => 3, 'status' => 'Wajib'],
            ['kode' => 'IF2302', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'status' => 'Wajib'],
            ['kode' => 'IF2303', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3, 'status' => 'Wajib'],
            ['kode' => 'IF2304', 'nama' => 'Analisis dan Perancangan Sistem', 'sks' => 3, 'semester' => 3, 'status' => 'Wajib'],
            ['kode' => 'IF2305', 'nama' => 'Pemrograman Web', 'sks' => 4, 'semester' => 3, 'status' => 'Wajib'],
            ['kode' => 'IF2306', 'nama' => 'Interaksi Manusia dan Komputer', 'sks' => 3, 'semester' => 3, 'status' => 'Wajib'],
            ['kode' => 'IF2307', 'nama' => 'Probabilitas dan Statistik', 'sks' => 4, 'semester' => 3, 'status' => 'Wajib'],

            // --- SEMESTER 4 (Total 20 SKS) --- 
            ['kode' => 'IF2401', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 4, 'status' => 'Wajib'],
            ['kode' => 'IF2402', 'nama' => 'Pemrograman Mobile', 'sks' => 3, 'semester' => 4, 'status' => 'Wajib'],
            ['kode' => 'IF2403', 'nama' => 'Keamanan Informasi', 'sks' => 3, 'semester' => 4, 'status' => 'Wajib'],
            ['kode' => 'IF2404', 'nama' => 'Sistem Informasi', 'sks' => 3, 'semester' => 4, 'status' => 'Wajib'],
            ['kode' => 'IF2405', 'nama' => 'Komputasi Awan', 'sks' => 3, 'semester' => 4, 'status' => 'Wajib'],
            ['kode' => 'IF2406', 'nama' => 'Metodologi Penelitian', 'sks' => 2, 'semester' => 4, 'status' => 'Wajib'],
            ['kode' => 'IF2407', 'nama' => 'Data Mining Dasar', 'sks' => 3, 'semester' => 4, 'status' => 'Wajib'],

            // --- SEMESTER 5 (Total 21 SKS) --- 
            ['kode' => 'IF3501', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 5, 'status' => 'Wajib'],
            ['kode' => 'IF3502', 'nama' => 'Data Warehouse', 'sks' => 3, 'semester' => 5, 'status' => 'Wajib'],
            ['kode' => 'IF3503', 'nama' => 'Machine Learning Dasar', 'sks' => 3, 'semester' => 5, 'status' => 'Wajib'],
            ['kode' => 'IF3504', 'nama' => 'Internet of Things', 'sks' => 3, 'semester' => 5, 'status' => 'Wajib'],
            ['kode' => 'IF3505', 'nama' => 'Pengolahan Citra Digital', 'sks' => 3, 'semester' => 5, 'status' => 'Wajib'],
            ['kode' => 'IF3506', 'nama' => 'Manajemen Proyek TI', 'sks' => 3, 'semester' => 5, 'status' => 'Wajib'],
            ['kode' => 'IF3507', 'nama' => 'Etika Profesi', 'sks' => 3, 'semester' => 5, 'status' => 'Wajib'],

            // --- SEMESTER 6 (Total 18 SKS) --- [cite: 87]
            ['kode' => 'IF3601', 'nama' => 'Data Science', 'sks' => 3, 'semester' => 6, 'status' => 'Wajib'],
            ['kode' => 'IF3602', 'nama' => 'Big Data', 'sks' => 3, 'semester' => 6, 'status' => 'Wajib'],
            ['kode' => 'IF3603', 'nama' => 'DevOps', 'sks' => 3, 'semester' => 6, 'status' => 'Wajib'],
            ['kode' => 'IF3604', 'nama' => 'Sistem Pendukung Keputusan', 'sks' => 3, 'semester' => 6, 'status' => 'Wajib'],
            ['kode' => 'IF3605', 'nama' => 'Kerja Praktik', 'sks' => 3, 'semester' => 6, 'status' => 'Wajib'],
            ['kode' => 'IF3606', 'nama' => 'Technopreneurship', 'sks' => 3, 'semester' => 6, 'status' => 'Wajib'],

            // --- SEMESTER 7 (Total 15 SKS) --- 
            ['kode' => 'IF4701', 'nama' => 'Seminar Proposal', 'sks' => 2, 'semester' => 7, 'status' => 'Wajib'],
            ['kode' => 'IF4702', 'nama' => 'Kuliah Kerja Nyata (KKN)', 'sks' => 3, 'semester' => 7, 'status' => 'Wajib'],
            ['kode' => 'IF4703', 'nama' => 'Audit Sistem Informasi', 'sks' => 3, 'semester' => 7, 'status' => 'Wajib'],
            ['kode' => 'IF4704', 'nama' => 'Mata Kuliah Pilihan 1', 'sks' => 3, 'semester' => 7, 'status' => 'Pilihan'],
            ['kode' => 'IF4705', 'nama' => 'Mata Kuliah Pilihan 2', 'sks' => 4, 'semester' => 7, 'status' => 'Pilihan'],

            // --- SEMESTER 8 (Total 6 SKS) --- [cite: 97]
            ['kode' => 'IF4801', 'nama' => 'Skripsi', 'sks' => 6, 'semester' => 8, 'status' => 'Wajib'],
        ];

        foreach ($kurikulum as $mk) {
            Matakuliah::create([
                'kode_matakuliah' => $mk['kode'],
                'nama_matakuliah' => $mk['nama'],
                'sks' => $mk['sks'],
                'semester' => $mk['semester'],
                'status' => $mk['status']
            ]);
        }
    }
}