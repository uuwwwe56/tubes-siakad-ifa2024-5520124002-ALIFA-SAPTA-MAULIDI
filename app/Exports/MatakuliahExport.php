<?php

namespace App\Exports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MatakuliahExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Matakuliah::query();
        if ($this->request->has('search') && $this->request->search != '') {
            $query->where('nama_matakuliah', 'like', '%' . $this->request->search . '%')
                ->orWhere('kode_matakuliah', 'like', '%' . $this->request->search . '%');
        }
        return $query->get();
    }

    public function headings(): array
    {
        return ['Kode Mata Kuliah', 'Nama Mata Kuliah'];
    }

    public function map($mk): array
    {
        return [$mk->kode_matakuliah, $mk->nama_matakuliah];
    }
}
