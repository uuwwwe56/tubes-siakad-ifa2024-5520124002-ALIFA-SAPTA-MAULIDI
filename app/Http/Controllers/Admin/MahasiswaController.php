<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    // Menampilkan Daftar Mahasiswa (Poin b.2.b - Lihat)
    public function index()
    {
        // Fitur Tambahan Bonus: Pencarian data berdasarkan NPM atau Nama (Poin e.2)
        $search = request('search');
        $mahasiswas = Mahasiswa::with('dosen') // Disesuaikan dengan relasi model (biasanya 'dosen')
            ->when($search, function ($query, $search) {
                return $query->where('npm', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            })->paginate(10)->withQueryString();

        return view('admin.mahasiswa.index', compact('mahasiswas', 'search'));
    }

    // Menampilkan Form Tambah Mahasiswa
    public function create()
    {
        // Mengambil semua data dosen untuk dropdown pilihan Dosen Wali
        $dosens = Dosen::orderBy('nama', 'asc')->get();
        return view('admin.mahasiswa.create', compact('dosens'));
    }

    // Menyimpan Data Mahasiswa & Akun User Baru (Poin b.2.b - Tambah + Poin b.3 Validasi)
    public function store(Request $request)
    {
        // PERBAIKAN: Menambahkan validasi lengkap untuk konsep baru (angkatan, semester_aktif, kelas)
        $request->validate([
            'npm'            => 'required|string|size:10|unique:mahasiswa,npm', 
            'nama'           => 'required|string|max:50', 
            'angkatan'       => 'required|integer|digits:4', // Harus berupa tahun 4 digit (contoh: 2024)
            'semester_aktif' => 'required|integer|between:1,8', // Dibatasi hanya semester 1 s.d 8
            'kelas'          => 'required|string|in:A,B,C', // Membatasi input hanya huruf kapital A, B, atau C
            'nidn'           => 'required|string|exists:dosen,nidn', // Validasi string biasa (bukan char)
        ], [
            'npm.required'            => 'NPM wajib diisi.',
            'npm.size'                => 'NPM harus tepat berukuran 10 digit.',
            'npm.unique'              => 'NPM sudah terdaftar di sistem.',
            'nama.required'           => 'Nama mahasiswa wajib diisi.',
            'nama.max'                => 'Nama mahasiswa maksimal 50 karakter.',
            'angkatan.required'       => 'Tahun Angkatan wajib diisi.',
            'angkatan.digits'         => 'Tahun Angkatan harus berupa 4 digit angka tahun.',
            'semester_aktif.required' => 'Semester Aktif wajib diisi.',
            'semester_aktif.between'  => 'Semester Aktif harus berada di kisaran angka 1 sampai 8.',
            'kelas.required'          => 'Kelas Paralel wajib dipilih.',
            'kelas.in'               => 'Pilihan Kelas Paralel yang sah hanya kelas A, B, atau C.',
            'nidn.required'           => 'Dosen Wali wajib dipilih.',
            'nidn.exists'             => 'Dosen Wali yang dipilih tidak valid.',
        ]);

        // Menggunakan Database Transaction agar jika salah satu insert gagal, database tidak corrupt
        DB::transaction(function () use ($request) {

            $user = User::create([
                'username' => 'mhs' . $request->npm,
                'password' => Hash::make('password123'),
                'role'     => 'mahasiswa'
            ]);

            Mahasiswa::create([
                'npm'            => $request->npm,
                'nama'           => $request->nama,
                'angkatan'       => $request->angkatan,
                'semester_aktif' => $request->semester_aktif,
                'kelas'          => $request->kelas,
                'nidn'           => $request->nidn,
                'user_id'        => $user->id
            ]);
        });
        
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa dan Akun Login berhasil dibuat!');
    }

    // Menampilkan Form Edit Mahasiswa
    public function edit($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $dosens = Dosen::orderBy('nama', 'asc')->get();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    // Memperbarui Data Mahasiswa (Poin b.2.b - Edit + Poin b.3 Validasi)
    public function update(Request $request, $npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);

        // PERBAIKAN: Menambahkan aturan validasi edit untuk menunjang proses kenaikan kelas / update semester aktif
        $request->validate([
            'nama'           => 'required|string|max:50',
            'angkatan'       => 'required|integer|digits:4',
            'semester_aktif' => 'required|integer|between:1,8',
            'kelas'          => 'required|string|in:A,B,C',
            'nidn'           => 'required|string|exists:dosen,nidn',
        ], [
            'nama.required'           => 'Nama mahasiswa wajib diisi.',
            'nama.max'                => 'Nama mahasiswa maksimal 50 karakter.',
            'angkatan.required'       => 'Tahun Angkatan wajib diisi.',
            'angkatan.digits'         => 'Tahun Angkatan harus berupa 4 digit angka tahun.',
            'semester_aktif.required' => 'Semester Aktif wajib diisi.',
            'semester_aktif.between'  => 'Semester Aktif harus berada di kisaran angka 1 sampai 8.',
            'kelas.required'          => 'Kelas Paralel wajib dipilih.',
            'kelas.in'               => 'Pilihan Kelas Paralel yang sah hanya kelas A, B, atau C.',
            'nidn.required'           => 'Dosen Wali wajib dipilih.',
            'nidn.exists'             => 'Dosen Wali yang dipilih tidak valid.',
        ]);

        // PERBAIKAN: update semua data array inputan agar perubahan kelas/semester bisa tersimpan permanen
        $mahasiswa->update($request->only(['nama', 'angkatan', 'semester_aktif', 'kelas', 'nidn']));

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    // Menghapus Data Mahasiswa beserta Akun Usernya (Poin b.2.b - Hapus)
    public function destroy($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);

        DB::transaction(function () use ($mahasiswa) {
            // Hapus user terkait (Otomatis profile mahasiswa ikut terhapus karena cascade di migration)
            if ($mahasiswa->user) {
                $mahasiswa->user->delete();
            } else {
                $mahasiswa->delete();
            }
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus dari sistem!');
    }
    public function resetPassword($id)
    {
        // 1. Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // 2. Buat string acak sepanjang 8 karakter (huruf & angka)
        $passwordAcak = Str::random(8);

        // 3. Simpan password yang sudah di-hash ke database
        $user->update([
            'password' => Hash::make($passwordAcak)
        ]);

        // 4. Kirim password asli (sebelum di-hash) ke session agar bisa dibaca Admin
        return redirect()->back()->with('success_password', [
            'username' => $user->username,
            'password' => $passwordAcak
        ]);
    }
    // ================= MAHASISWA =================
    public function exportMahasiswaExcel(Request $request)
    {
        return Excel::download(new MahasiswaExport($request), 'data-mahasiswa.xlsx');
    }

    public function importMahasiswaExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            Excel::import(new MahasiswaImport, $request->file('file'));
            return back()->with('success', 'Data Mahasiswa Berhasil Diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return back()->withErrors($e->failures());
        }
    }

    public function exportMahasiswaPdf(Request $request)
    {
        $data = Mahasiswa::query()->when($request->search, function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        })->get();
        $pdf = Pdf::loadView('admin.reports.mahasiswa_pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan-mahasiswa.pdf');
    }
}