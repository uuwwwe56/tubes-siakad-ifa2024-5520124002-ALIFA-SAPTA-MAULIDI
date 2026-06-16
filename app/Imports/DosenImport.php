<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DosenImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Dosen([
            'nidn' => $row['nidn'],
            'nama' => $row['nama_dosen'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nidn' => 'required|string|size:10|unique:dosen,nidn',
            'nama_dosen' => 'required|string|max:50',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nidn.required' => 'NIDN tidak boleh kosong.',
            'nidn.unique' => 'NIDN sudah terdaftar (Duplikat).',
            'nidn.size' => 'NIDN harus tepat 10 karakter.',
            'nama_dosen.required' => 'Nama dosen tidak boleh kosong.',
        ];
    }
}
