<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $mahasiswa = $user->mahasiswa;

        // Jika data mahasiswa tidak ditemukan
        if (!$mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan.');
        }

        // Ambil seluruh KRS mahasiswa
        $krs = Krs::with('matakuliah')
            ->where('npm', $mahasiswa->npm)
            ->get();

        // Hitung jumlah mata kuliah
        $jumlahMk = $krs->count();

        // Hitung total SKS
        $totalSks = $krs->sum(function ($item) {
            return $item->matakuliah->sks ?? 0;
        });

        // ✔️ FIX PENTING: ambil status KRS
        $statusKrs = $krs->first()->status ?? 'belum';

        return view('mahasiswa.dashboard', compact(
            'mahasiswa',
            'jumlahMk',
            'totalSks',
            'statusKrs'
        ));
    }
}
