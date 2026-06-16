<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Mahasiswa::with('dosen');

        if ($this->request->has('search') && $this->request->search != '') {
            $query->where('nama', 'like', '%' . $this->request->search . '%')
                ->orWhere('npm', 'like', '%' . $this->request->search . '%');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['NPM', 'NIDN Wali', 'Nama Mahasiswa'];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->npm,
            $mahasiswa->nidn,
            $mahasiswa->nama,
        ];
    }
}
