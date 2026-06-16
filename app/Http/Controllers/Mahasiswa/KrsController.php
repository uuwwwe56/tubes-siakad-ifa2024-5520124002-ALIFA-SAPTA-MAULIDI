<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    // Menampilkan halaman Krs
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Mengambil data KRS yang sudah diambil mahasiswa saat ini
        $krsData = Krs::where('npm', $mahasiswa->npm)->get();

        // KUNCI UTAMA: Menentukan status global halaman berdasarkan isi tabel database
        if ($krsData->isEmpty()) {
            $status_krs = 'Draft';
        } else {
            $status_krs = $krsData->first()->status ?? 'Draft';
        }

        // Mengambil daftar matakuliah berdasarkan semester aktif mahasiswa
        $matakuliahs = MataKuliah::with('jadwals.dosen')
            ->where('semester', $mahasiswa->semester_aktif)
            ->get();

        return view('mahasiswa.krs.index', compact('mahasiswa', 'matakuliahs', 'krsData', 'status_krs'));
    }

    // Mengajukan/Submit KRS ke Dosen Wali
    public function store(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Validasi input array mata kuliah (Dihapus cek 'exists' ke tabel spesifik untuk menghindari crash beda nama tabel)
        $request->validate([
            'matakuliah' => 'required|array|min:1',
        ]);

        // Validasi apakah mata kuliah yang dipilih memang sesuai dengan semester mahasiswa
        $validMk = MataKuliah::where('semester', $mahasiswa->semester_aktif)
            ->whereIn('kode_matakuliah', $request->matakuliah)
            ->count();

        if ($validMk != count($request->matakuliah)) {
            return redirect()->back()->with('error', 'Terdapat mata kuliah yang tidak valid untuk semester Anda.');
        }

        // Jangan izinkan submit ulang jika status di database sudah resmi 'disetujui'
        $isDisetujui = Krs::where('npm', $mahasiswa->npm)
            ->where('status', 'Disetujui')
            ->exists();

        if ($isDisetujui) {
            return redirect()->back()->with('error', 'KRS Anda sudah disetujui resmi oleh Dosen Wali dan telah terkunci.');
        }

        // Cek Batasan SKS Maksimal
        $totalSks = MataKuliah::whereIn('kode_matakuliah', $request->matakuliah)->sum('sks');
        if ($totalSks > 24) {
            return redirect()->back()->with('error', 'Total SKS tidak boleh lebih dari 24 SKS.');
        }

        // Simpan data pilihan dengan aman menggunakan Database Transaction
        DB::transaction(function () use ($request, $mahasiswa) {
            // Bersihkan data lama agar tidak menumpuk duplikat
            Krs::where('npm', $mahasiswa->npm)->delete();

            // Masukkan baris data baru dengan penanda status 'pending'
            foreach ($request->matakuliah as $kode_mk) {
                Krs::create([
                    'npm'               => $mahasiswa->npm,
                    'kode_matakuliah'    => $kode_mk,
                    'status' => 'Menunggu Persetujuan',
                    'semester_ditempuh'  => $mahasiswa->semester_aktif
                ]);
            }
        });

        return redirect()->route('mahasiswa.krs.index')->with('success', 'KRS Berhasil diajukan ke Dosen Wali!');
    }

    // Fitur Cancel/Batalkan Pengajuan KRS untuk diperbaiki kembali
    public function cancel()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // 1. Ambil data KRS milik mahasiswa ini
        $krsQuery = Krs::where('npm', $mahasiswa->npm);

        // 2. Keamanan Tingkat Tinggi: Jika ternyata sudah ada status 'disetujui' atau 'Disetujui', JANGAN izinkan cancel
        $isAlreadyApproved = (clone $krsQuery)->whereIn('status', ['disetujui', 'Disetujui'])->exists();
        if ($isAlreadyApproved) {
            return redirect()->back()->with('error', 'Tidak ada pengajuan KRS aktif yang bisa dibatalkan karena KRS Anda sudah disetujui resmi oleh Dosen Wali.');
        }

        // 3. Cari tahu apakah ada pengajuan aktif (baik bertuliskan 'pending' maupun 'Menunggu Persetujuan')
        $hasActiveSubmission = (clone $krsQuery)->whereIn('status', ['pending', 'Menunggu Persetujuan'])->exists();

        if (!$hasActiveSubmission) {
            return redirect()->back()->with('error', 'Gagal membatalkan. Tidak ditemukan adanya pengajuan KRS yang berstatus menunggu persetujuan.');
        }

        // 4. Eksekusi Pengubahan Status: Kembalikan semua data pending menjadi 'draft'
        $krsQuery->whereIn('status', ['pending', 'Menunggu Persetujuan'])
            ->update(['status' => 'Draft']);

        return redirect()->route('mahasiswa.krs.index')->with('success', 'Pengajuan KRS berhasil dibatalkan! Silakan sesuaikan kembali pilihan mata kuliah Anda.');
    }

    // Cetak KRS (Print) Sesuai Status Terkini
    public function print()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $krsData = Krs::with([
            'matakuliah.jadwals.dosen',
            'mahasiswa'
        ])
            ->where('npm', $mahasiswa->npm)
            ->get();

        $status_krs = $krsData->first()->status ?? 'Draft';

        $pdf = Pdf::loadView(
            'mahasiswa.krs.print',
            compact('mahasiswa', 'krsData', 'status_krs')
        )->setPaper('a4', 'portrait');

        return $pdf->download('KRS_' . $mahasiswa->nama . '.pdf');
    }
}
