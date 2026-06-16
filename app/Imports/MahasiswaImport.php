<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Mahasiswa([
            'npm'  => $row['npm'],
            'nidn' => $row['nidn_wali'],
            'nama' => $row['nama_mahasiswa'],
        ]);
    }

    public function rules(): array
    {
        return [
            'npm' => 'required|string|size:10|unique:mahasiswa,npm',
            'nidn_wali' => 'required|string|exists:dosen,nidn',
            'nama_mahasiswa' => 'required|string|max:50',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'npm.required' => 'NPM tidak boleh kosong.',
            'npm.unique' => 'NPM sudah terdaftar.',
            'nidn_wali.exists' => 'NIDN Wali tidak ditemukan di data dosen.',
            'nama_mahasiswa.required' => 'Nama mahasiswa tidak boleh kosong.',
        ];
    }
}
