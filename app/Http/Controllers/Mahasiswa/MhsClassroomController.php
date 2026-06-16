<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Pertemuan;
use App\Models\Absensi;
use App\Models\Tugas;
use App\Models\TugasSubmission;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MhsClassroomController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $krsDisetujui = Krs::where('npm', $mahasiswa->npm)->where('status', 'disetujui')->pluck('kode_matakuliah');

        $kelasSaya = Jadwal::whereIn('kode_matakuliah', $krsDisetujui)
            ->where('kelas', $mahasiswa->kelas)
            ->with(['matakuliah', 'dosen'])
            ->get();

        return view('mahasiswa.classroom.index', compact('kelasSaya'));
    }

    public function show($id)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $kelas = Jadwal::with(['matakuliah', 'dosen'])->findOrFail($id);

        // Ambil data pertemuan beserta relasi materi, tugas, absensi saya, dan status submission saya
        $pertemuans = Pertemuan::where('jadwal_id', $id)
            ->with(['materis', 'tugases' => function ($query) use ($mahasiswa) {
                $query->with(['submissions' => function ($sub) use ($mahasiswa) {
                    $sub->where('npm', $mahasiswa->npm);
                }]);
            }, 'absensis' => function ($query) use ($mahasiswa) {
                $query->where('npm', $mahasiswa->npm);
            }])
            ->orderBy('pertemuan_ke', 'asc')
            ->get();

        return view('mahasiswa.classroom.show', compact('kelas', 'pertemuans', 'mahasiswa'));
    }

    // Fungsi Absensi Mandiri Mahasiswa
    public function storeAbsensi(Request $request, $pertemuanId)
    {
        $request->validate([
            'status' => 'required|in:hadir,sakit,izin,alfa'
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        // Gunakan updateOrCreate untuk menghindari duplikasi data absen di satu pertemuan
        Absensi::updateOrCreate(
            ['pertemuan_id' => $pertemuanId, 'npm' => $mahasiswa->npm],
            ['status' => $request->status]
        );

        return redirect()->back()->with('success', 'Presensi kehadiran Anda berhasil disimpan.');
    }

    public function submitTugas(Request $request, $tugasId)
    {
        $request->validate([
            'file_jawaban' => 'required|mimes:pdf,jpg,jpeg|max:2048',
            'catatan_mahasiswa' => 'nullable|string'
        ], [
            'file_jawaban.mimes' => 'Format file harus berupa PDF atau JPG/JPEG.',
            'file_jawaban.max' => 'Ukuran file maksimal adalah 2 Megabytes (2MB).'
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        $submissionLama = TugasSubmission::where('tugas_id', $tugasId)
            ->where('npm', $mahasiswa->npm)
            ->first();

        $filePath = $submissionLama ? $submissionLama->file_jawaban : null;

        if ($request->hasFile('file_jawaban')) {

            // Hapus file lama jika upload ulang
            if (
                $submissionLama &&
                $submissionLama->file_jawaban &&
                Storage::disk('public')->exists($submissionLama->file_jawaban)
            ) {
                Storage::disk('public')->delete($submissionLama->file_jawaban);
            }

            $file = $request->file('file_jawaban');

            $extension = $file->getClientOriginalExtension();

            $namaMahasiswa = Str::slug($mahasiswa->nama);

            $namaFile = "TUGAS-{$tugasId}_{$mahasiswa->npm}_{$namaMahasiswa}.{$extension}";

            $filePath = $file->storeAs(
                "classroom/submissions/tugas-{$tugasId}",
                $namaFile,
                'public'
            );
        }

        TugasSubmission::updateOrCreate(
            [
                'tugas_id' => $tugasId,
                'npm' => $mahasiswa->npm
            ],
            [
                'file_jawaban' => $filePath,
                'catatan_mahasiswa' => $request->catatan_mahasiswa
            ]
        );

        return redirect()->back()->with(
            'success',
            'Tugas kuliah Anda berhasil diunggah ke server.'
        );
    }
}
