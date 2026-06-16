<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Exports\JadwalExport;
use App\Imports\JadwalImport;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalController extends Controller
{
    // Menampilkan Daftar Jadwal (Poin b.2.d - Lihat)
    public function index()
    {
        // Menggunakan eager loading (with) agar query database efisien (tidak N+1 problem)
        $search = request('search');
        $jadwals = Jadwal::with(['matakuliah', 'dosen'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('matakuliah', function ($q) use ($search) {
                    $q->where('nama_matakuliah', 'like', "%{$search}%");
                })->orWhereHas('dosen', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })->paginate(10)->withQueryString();

        return view('admin.jadwal.index', compact('jadwals', 'search'));
    }

    // Menampilkan Form Tambah Jadwal
    public function create()
    {
        $matakuliahs = Matakuliah::orderBy('nama_matakuliah', 'asc')->get();
        $dosens = Dosen::orderBy('nama', 'asc')->get();
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin.jadwal.create', compact('matakuliahs', 'dosens', 'haris'));
    }

    // Menyimpan Data Jadwal Baru (Poin b.2.d - Tambah + Poin b.3 Validasi)
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|string|size:10|exists:dosen,nidn',
            'kelas'           => 'required|string|size:1',
            'hari'            => 'required|string|max:10',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required|after:jam_mulai',
        ], [
            'kode_matakuliah.required' => 'Mata Kuliah wajib dipilih.',
            'kode_matakuliah.exists' => 'Mata Kuliah tidak valid.',
            'nidn.required' => 'Dosen Pengajar wajib dipilih.',
            'nidn.exists' => 'Dosen Pengajar tidak valid.',
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.size' => 'Format kelas harus berupa 1 karakter huruf (Contoh: A).',
            'hari.required' => 'Hari perkuliahan wajib dipilih.',
            'jam.required' => 'Jam perkuliahan wajib diisi.',
        ]);

        Jadwal::create([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn'            => $request->nidn,
            'kelas'           => $request->kelas,
            'hari'            => $request->hari,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Perkuliahan berhasil ditambahkan!');
    }

    // Menampilkan Form Edit Jadwal
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $matakuliahs = Matakuliah::orderBy('nama_matakuliah', 'asc')->get();
        $dosens = Dosen::orderBy('nama', 'asc')->get();
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin.jadwal.edit', compact('jadwal', 'matakuliahs', 'dosens', 'haris'));
    }

    // Memperbarui Data Jadwal (Poin b.2.d - Edit + Poin b.3 Validasi)
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'kode_matakuliah' => 'required|string|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|string|size:10|exists:dosen,nidn',
            'kelas'           => 'required|string|size:1',
            'hari'            => 'required|string|max:10',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required|after:jam_mulai',
        ], [
            'kode_matakuliah.required' => 'Mata Kuliah wajib dipilih.',
            'kode_matakuliah.exists' => 'Mata Kuliah tidak valid.',
            'nidn.required' => 'Dosen Pengajar wajib dipilih.',
            'nidn.exists' => 'Dosen Pengajar tidak valid.',
            'kelas.required' => 'Kelas wajib diisi.',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Perkuliahan berhasil diperbarui!');
    }

    // Menghapus Data Jadwal (Poin b.2.d - Hapus)
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Perkuliahan berhasil dihapus!');
    }
    // ================= JADWAL KULIAH =================
    public function exportJadwalExcel(Request $request)
    {
        return Excel::download(new JadwalExport($request), 'data-jadwal.xlsx');
    }

    public function importJadwalExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            Excel::import(new JadwalImport, $request->file('file'));
            return back()->with('success', 'Data Jadwal Berhasil Diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal Mengimport Jadwal.');
        }
    }

    public function exportJadwalPdf(Request $request)
    {
        $data = Jadwal::with(['dosen', 'matakuliah'])->get();
        $pdf = Pdf::loadView('admin.reports.jadwal_pdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-jadwal.pdf');
    }
}
