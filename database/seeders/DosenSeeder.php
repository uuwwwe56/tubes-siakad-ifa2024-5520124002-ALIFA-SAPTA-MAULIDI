<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $dosens = [
            ['nidn' => '041001001', 'nama' => 'Dr. Ahmad Fauzi, M.Kom.'],
            ['nidn' => '041001002', 'nama' => 'Dr. Budi Santoso, M.T.'],
            ['nidn' => '041001003', 'nama' => 'Dr. Rina Marlina, M.Kom.'],
            ['nidn' => '041001004', 'nama' => 'Dr. Dedi Kurniawan, M.Sc.'],
            ['nidn' => '041001005', 'nama' => 'Dr. Siti Nurhaliza, M.Kom.'],
            ['nidn' => '041001006', 'nama' => 'Dr. Andi Saputra, M.T.'],
            ['nidn' => '041001007', 'nama' => 'Dr. Yuni Astuti, M.Kom.'],
            ['nidn' => '041001008', 'nama' => 'Dr. Eko Prasetyo, M.Sc.'],
            ['nidn' => '041001009', 'nama' => 'Dr. Muhammad Rizki, M.Kom.'],
            ['nidn' => '041001010', 'nama' => 'Dr. Fajar Nugraha, M.T.'],
            ['nidn' => '041001011', 'nama' => 'Dr. Ratna Dewi, M.Kom.'],
            ['nidn' => '041001012', 'nama' => 'Dr. Agus Setiawan, M.Sc.'],
            ['nidn' => '041001013', 'nama' => 'Dr. Maya Sari, M.Kom.'],
            ['nidn' => '041001014', 'nama' => 'Dr. Hendra Wijaya, M.T.'],
            ['nidn' => '041001015', 'nama' => 'Dr. Dian Puspita, M.Kom.'],
        ];

        foreach ($dosens as $dosenData) {

            $user = User::create([
                'username' => $dosenData['nidn'],
                'password' => Hash::make('dosen123'),
                'role' => 'dosen'
            ]);

            Dosen::create([
                'nidn' => $dosenData['nidn'],
                'nama' => $dosenData['nama'],
                'user_id' => $user->id
            ]);
        }
    }
}
