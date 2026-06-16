<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission; // Sesuaikan dengan nama model Tugas/Submission Anda
use App\Models\TugasSubmission;
use Illuminate\Support\Facades\Storage;

class TugasSubmissionController extends Controller
{
    public function update(Request $request, $id)
    {
        $submission = TugasSubmission::findOrFail($id);

        $request->validate([
            'file_jawaban' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        // Hapus file lama dari storage
        if ($submission->file_jawaban) {
            Storage::disk('public')->delete($submission->file_jawaban);
        }

        // Simpan file baru
        $path = $request->file('file_jawaban')->store('submissions', 'public');

        $submission->update([
            'file_jawaban' => $path,
            'catatan_mahasiswa' => $request->catatan_mahasiswa
        ]);

        return redirect()->back()->with('success', 'Jawaban tugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $submission = TugasSubmission::findOrFail($id);

        // Hapus berkas fisik dari storage
        if ($submission->file_jawaban) {
            Storage::disk('public')->delete($submission->file_jawaban);
        }

        // Hapus baris data dari database
        $submission->delete();

        return redirect()->back()->with('success', 'Jawaban tugas berhasil dihapus!');
    }
}
