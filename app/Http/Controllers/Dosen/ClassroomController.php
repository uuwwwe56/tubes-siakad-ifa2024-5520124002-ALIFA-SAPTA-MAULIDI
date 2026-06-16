<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Pertemuan;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\TugasSubmission;
use App\Models\Absensi;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ClassroomController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;
        $kelasMengajar = Jadwal::where('nidn', $dosen->nidn)->with(['matakuliah'])->get();
        return view('dosen.classroom.index', compact('kelasMengajar'));
    }

    public function show($id)
    {
        $kelas = Jadwal::with(['matakuliah'])->findOrFail($id);

        // Ambil data pertemuan beserta materi, tugas, submission nilai, dan absensi yang sudah tercatat
        $pertemuans = Pertemuan::where('jadwal_id', $id)
            ->with(['materis', 'tugases.submissions.mahasiswa', 'absensis'])
            ->orderBy('pertemuan_ke', 'asc')
            ->get();

        // Ambil daftar mahasiswa yang mengambil kelas ini berdasarkan KRS yang disetujui
        $mahasiswaKelas = Mahasiswa::where('kelas', $kelas->kelas)
            ->whereHas('krs', function ($q) use ($kelas) {
                $q->where('kode_matakuliah', $kelas->kode_matakuliah)->where('status', 'disetujui');
            })->orderBy('nama', 'asc')->get();

        return view('dosen.classroom.show', compact('kelas', 'pertemuans', 'mahasiswaKelas'));
    }

    public function storePertemuan(Request $request, $jadwalId)
    {
        $request->validate([
            'pertemuan_ke' => 'required|integer',
            'judul_topik' => 'required|string|max:255',
        ]);

        Pertemuan::create([
            'jadwal_id' => $jadwalId,
            'pertemuan_ke' => $request->pertemuan_ke,
            'judul_topik' => $request->judul_topik,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Pertemuan berhasil dibuat.');
    }

    public function storeMateri(Request $request, $pertemuanId)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'file_materi' => 'required|mimes:pdf,docx,pptx,zip|max:10000',
        ]);

        $pertemuan = Pertemuan::findOrFail($pertemuanId);

        $filePath = null;

        if ($request->hasFile('file_materi')) {

            $file = $request->file('file_materi');

            $extension = $file->getClientOriginalExtension();

            $judulFile = Str::slug($request->judul_materi);

            $namaFile = "MATERI-P{$pertemuan->pertemuan_ke}_{$judulFile}.{$extension}";

            $filePath = $file->storeAs(
                "classroom/materi/pertemuan-{$pertemuan->pertemuan_ke}",
                $namaFile,
                'public'
            );
        }

        Materi::create([
            'pertemuan_id' => $pertemuanId,
            'judul_materi' => $request->judul_materi,
            'file_path' => $filePath
        ]);

        return redirect()->back()
            ->with('success', 'Materi berhasil diunggah.');
    }

    public function storeTugas(Request $request, $pertemuanId)
    {
        $request->validate([
            'judul_tugas' => 'required|string|max:255',
            'instruksi' => 'required|string',
            'deadline' => 'required|date',
        ]);

        Tugas::create([
            'pertemuan_id' => $pertemuanId,
            'judul_tugas' => $request->judul_tugas,
            'instruksi' => $request->instruksi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function storeAbsensi(Request $request, $pertemuanId)
    {
        // $request->status berupa array dengan key = NPM dan value = status (hadir/sakit/izin/alfa)
        $request->validate([
            'status' => 'required|array'
        ]);

        foreach ($request->status as $npm => $statusKehadiran) {
            Absensi::updateOrCreate(
                ['pertemuan_id' => $pertemuanId, 'npm' => $npm],
                ['status' => $statusKehadiran]
            );
        }

        return redirect()->back()->with('success', 'Presensi mahasiswa berhasil disimpan/diperbarui.');
    }

    public function gradeTugas(Request $request, $submissionId)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'catatan_dosen' => 'nullable|string'
        ]);

        $submission = TugasSubmission::findOrFail($submissionId);
        $submission->update([
            'nilai' => $request->nilai,
            'catatan_dosen' => $request->catatan_dosen
        ]);

        return redirect()->back()->with('success', 'Nilai tugas berhasil disimpan.');
    }

   

    public function toggleAbsensi($id)
    {
        // 1. Cari data pertemuan berdasarkan ID
        $pertemuan = Pertemuan::findOrFail($id);

        // 2. Balikkan status nilai is_absensi_active (jika 1/true jadi 0/false, jika 0/false jadi 1/true)
        $pertemuan->is_absensi_active = !$pertemuan->is_absensi_active;

        // 3. Simpan perubahan ke database
        $pertemuan->save();

        // 4. Berikan pesan notifikasi sukses dan kembalikan ke halaman sebelumnya
        $statusPesan = $pertemuan->is_absensi_active ? 'diaktifkan' : 'ditutup';
        return redirect()->back()->with('success', "Sesi absensi pertemuan ke-{$pertemuan->pertemuan_ke} berhasil {$statusPesan}!");
    }
}
