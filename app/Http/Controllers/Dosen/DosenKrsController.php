<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DosenKrsController extends Controller
{
    // Menampilkan daftar mahasiswa bimbingan beserta status KRS-nya
    public function index()
    {
        // Ambil data dosen yang sedang login (Sesuaikan dengan nama relasi di User Anda)
        $dosen = Auth::user()->dosen;
        // dd(Auth::user(), $dosen);

        $mahasiswas = Mahasiswa::where('nidn', $dosen->nidn)
            ->with(['krs.matakuliah'])
            ->get()
            ->map(function ($mhs) {
                // Kelompokkan data KRS mahasiswa
                $krsData = $mhs->krs;

                // Hitung total SKS yang diajukan
                $mhs->total_sks = $krsData->sum(function ($item) {
                    return $item->matakuliah->sks ?? 0;
                });

                // Tentukan status global KRS mahasiswa ini
                if ($krsData->isEmpty()) {
                    $mhs->status_krs = 'Belum Mengisi';
                } else {
                    if ($krsData->contains('status', 'Disetujui')) {
                        $mhs->status_krs = 'Disetujui';
                    } elseif ($krsData->contains('status', 'Ditolak')) {
                        $mhs->status_krs = 'Ditolak';
                    } elseif ($krsData->contains('status', 'Menunggu Persetujuan')) {
                        $mhs->status_krs = 'Menunggu Persetujuan';
                    } else {
                        $mhs->status_krs = 'Draft';
                    }
                }

                return $mhs;
            });

        return view('dosen.krs.index', compact('dosen', 'mahasiswas'));
    }

    // Memproses Persetujuan atau Penolakan KRS Mahasiswa
    public function verifikasi(Request $request, $npm)
    {
        $request->validate([
            'action' => 'required|in:setujui,tolak'
        ]);

        $statusBaru = $request->action == 'setujui'
            ? 'Disetujui'
            : 'Ditolak';
        $pesanSukses = $request->action == 'setujui'
            ? 'KRS Mahasiswa berhasil disetujui!'
            : 'KRS Mahasiswa berhasil ditolak.';

        // Update status semua baris KRS milik mahasiswa tersebut
        Krs::where('npm', $npm)
            ->where('status', 'Menunggu Persetujuan')
            ->update([
                'status' => $statusBaru
            ]);

        return redirect()->back()->with('success', $pesanSukses);
    }
}
