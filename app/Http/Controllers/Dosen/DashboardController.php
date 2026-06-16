<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;

        $mahasiswaIds = Mahasiswa::where('nidn', $dosen->nidn)
            ->pluck('npm');

        $totalMahasiswa = $mahasiswaIds->count();

        $menunggu = Krs::whereIn('npm', $mahasiswaIds)
            ->where('status', 'Menunggu Persetujuan')
            ->distinct('npm')
            ->count();

        $disetujui = Krs::whereIn('npm', $mahasiswaIds)
            ->where('status', 'Disetujui')
            ->distinct('npm')
            ->count();

        $ditolak = Krs::whereIn('npm', $mahasiswaIds)
            ->where('status', 'Ditolak')
            ->distinct('npm')
            ->count();

        $pengajuanTerbaru = Mahasiswa::where('nidn', $dosen->nidn)
            ->with('krs')
            ->take(5)
            ->get();

        return view('dosen.dashboard', compact(
            'dosen',
            'totalMahasiswa',
            'menunggu',
            'disetujui',
            'ditolak',
            'pengajuanTerbaru'
        ));
    }
}
