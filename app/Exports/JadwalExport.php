<?php

namespace App\Exports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JadwalExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Jadwal::with(['dosen', 'matakuliah']);
        if ($this->request->has('hari') && $this->request->hari != '') {
            $query->where('hari', $this->request->hari);
        }
        return $query->get();
    }

    public function headings(): array
    {
        return ['ID', 'Kode MK', 'NIDN Dosen', 'Kelas', 'Hari', 'Jam'];
    }

    public function map($jadwal): array
    {
        return [
            $jadwal->id,
            $jadwal->kode_matakuliah,
            $jadwal->nidn,
            $jadwal->kelas,
            $jadwal->hari,
            $jadwal->jam,
        ];
    }
}
