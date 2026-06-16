<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DosenExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        // Menyesuaikan hasil pencarian/filter di dashboard
        $query = Dosen::query();

        if ($this->request->has('search') && $this->request->search != '') {
            $query->where('nama', 'like', '%' . $this->request->search . '%')
                ->orWhere('nidn', 'like', '%' . $this->request->search . '%');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['NIDN', 'Nama Dosen'];
    }

    public function map($dosen): array
    {
        return [
            $dosen->nidn,
            $dosen->nama,
        ];
    }
}
