<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use App\Exports\MatakuliahExport;
use App\Imports\MatakuliahImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class MatakuliahController extends Controller
{
    // Menampilkan Daftar Mata Kuliah (Poin b.2.c - Lihat)
    public function index()
    {
        // Fitur Tambahan Bonus: Pencarian berdasarkan Kode atau Nama MK (Poin e.2)
        $search = request('search');
        $matakuliahs = Matakuliah::when($search, function ($query, $search) {
            return $query->where('kode_matakuliah', 'like', "%{$search}%")
                ->orWhere('nama_matakuliah', 'like', "%{$search}%");
        })->orderBy('kode_matakuliah', 'asc')->paginate(10)->withQueryString();

        return view('admin.matakuliah.index', compact('matakuliahs', 'search'));
    }

    // Menampilkan Form Tambah Mata Kuliah
    public function create()
    {
        return view('admin.matakuliah.create');
    }

    // Menyimpan Data Mata Kuliah Baru (Poin b.2.c - Tambah + Poin b.3 Validasi)
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|size:8|unique:matakuliah,kode_matakuliah', // Sesuai ketentuan char(8)
            'nama_matakuliah' => 'required|string|max:50', // Sesuai ketentuan varchar(50)
            'sks' => 'required|integer|min:1|max:6', // Validasi rentang SKS rasional
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah wajib diisi.',
            'kode_matakuliah.size' => 'Kode mata kuliah harus tepat berukuran 8 karakter.',
            'kode_matakuliah.unique' => 'Kode mata kuliah sudah digunakan.',
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'nama_matakuliah.max' => 'Nama mata kuliah maksimal 50 karakter.',
            'sks.required' => 'Jumlah SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa nomor angka.',
            'sks.min' => 'SKS minimal bernilai 1.',
            'sks.max' => 'SKS maksimal bernilai 6.',
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    // Menampilkan Form Edit Mata Kuliah
    public function edit($kode_matakuliah)
    {
        $matakuliah = Matakuliah::findOrFail($kode_matakuliah);
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    // Memperbarui Data Mata Kuliah (Poin b.2.c - Edit + Poin b.3 Validasi)
    public function update(Request $request, $kode_matakuliah)
    {
        $matakuliah = Matakuliah::findOrFail($kode_matakuliah);

        $request->validate([
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ], [
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'nama_matakuliah.max' => 'Nama mata kuliah maksimal 50 karakter.',
            'sks.required' => 'Jumlah SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa nomor angka.',
            'sks.min' => 'SKS minimal bernilai 1.',
            'sks.max' => 'SKS maksimal bernilai 6.',
        ]);

        $matakuliah->update($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui!');
    }

    // Menghapus Data Mata Kuliah (Poin b.2.c - Hapus)
    public function destroy($kode_matakuliah)
    {
        $matakuliah = Matakuliah::findOrFail($kode_matakuliah);
        $matakuliah->delete();

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
    // ================= MATA KULIAH =================
    public function exportMatakuliahExcel(Request $request)
    {
        return Excel::download(new MatakuliahExport($request), 'data-matakuliah.xlsx');
    }

    public function importMatakuliahExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            Excel::import(new MatakuliahImport, $request->file('file'));
            return back()->with('success', 'Data Mata Kuliah Berhasil Diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal Mengimport Data! Ada ketidaksesuaian/duplikasi.');
        }
    }

    public function exportMatakuliahPdf(Request $request)
    {
        $data = Matakuliah::all();
        $pdf = Pdf::loadView('admin.reports.matakuliah_pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan-matakuliah.pdf');
    }
}
