<?php

namespace App\Imports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MatakuliahImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Matakuliah([
            'kode_matakuliah' => $row['kode_mata_kuliah'],
            'nama_matakuliah' => $row['nama_mata_kuliah'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_mata_kuliah' => 'required|string|max:8|unique:matakuliah,kode_matakuliah',
            'nama_mata_kuliah' => 'required|string|max:50',
        ];
    }
}
