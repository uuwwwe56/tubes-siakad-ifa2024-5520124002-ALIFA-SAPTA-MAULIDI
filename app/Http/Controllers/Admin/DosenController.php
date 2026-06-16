<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DosenController extends Controller
{
    // Menampilkan Daftar Dosen (Poin b.2.a - Lihat)
    public function index()
    {
        // Fitur Tambahan Bonus: Pencarian data jika ada input 'search' (Poin e.2)
        $search = request('search');
        $dosens = Dosen::when($search, function ($query, $search) {
            return $query->where('nidn', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();

        return view('admin.dosen.index', compact('dosens', 'search'));
    }

    // Menampilkan Form Tambah Dosen
    public function create()
    {
        return view('admin.dosen.create');
    }

    // Menyimpan Data Dosen Baru ke Database (Poin b.2.a - Tambah + Poin b.3 Validasi)
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|digits:10|unique:dosen,nidn',
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.digits' => 'NIDN harus terdiri dari 10 digit angka.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max' => 'Nama dosen maksimal 50 karakter.',
        ]);

        Dosen::create($request->all());

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil ditambahkan!');
    }

    // Menampilkan Form Edit Dosen
    public function edit($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        return view('admin.dosen.edit', compact('dosen'));
    }

    // Memperbarui Data Dosen (Poin b.2.a - Edit + Poin b.3 Validasi)
    public function update(Request $request, $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);

        $request->validate([
            'nama' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max' => 'Nama dosen maksimal 50 karakter.',
        ]);

        $dosen->update($request->all());

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil diperbarui!');
    }

    // Menghapus Data Dosen (Poin b.2.a - Hapus)
    public function destroy($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil dihapus!');
    }

    // ================= DOSEN =================
    public function exportDosenExcel(Request $request)
    {
        return Excel::download(new DosenExport($request), 'data-dosen.xlsx');
    }

    public function importDosenExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            Excel::import(new DosenImport, $request->file('file'));
            return back()->with('success', 'Data Dosen Berhasil Diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return back()->withErrors($e->failures())->with('error', 'Import gagal, periksa format data.');
        }
    }

    public function exportDosenPdf(Request $request)
    {
        $query = Dosen::query();
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        $data = $query->get();
        $pdf = Pdf::loadView('admin.reports.dosen_pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan-dosen.pdf');
    }
}
