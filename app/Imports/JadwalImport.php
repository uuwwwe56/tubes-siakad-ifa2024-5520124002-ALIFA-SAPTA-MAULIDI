<?php

namespace App\Imports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class JadwalImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Jadwal([
            'kode_matakuliah' => $row['kode_mk'],
            'nidn'            => $row['nidn_dosen'],
            'kelas'           => $row['kelas'],
            'hari'            => $row['hari'],
            'jam'             => $row['jam'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_mk'    => 'required|exists:matakuliah,kode_matakuliah',
            'nidn_dosen' => 'required|exists:dosen,nidn',
            'kelas'      => 'required|string|max:1',
            'hari'       => 'required|string|max:10',
            'jam'        => 'required',
        ];
    }
}
