<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MatakuliahController;

// Dosen
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Dosen\DosenKrsController;
use App\Http\Controllers\Dosen\ClassroomController;

// Mahasiswa
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Mahasiswa\MhsClassroomController;
use App\Http\Controllers\Mahasiswa\TugasSubmissionController;

/*
|--------------------------------------------------------------------------
| Guest (Publik / Belum Login)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    // PERBAIKAN: Jalur menuju halaman instruksi lupa password via BAUK
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});

/*
|--------------------------------------------------------------------------
| Authenticated Users (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Jalur halaman profil terpusat untuk semua role yang sudah login
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    /*
    |-- Admin Area
    */
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

            // ================= MODUL DOSEN =================
            Route::get('/dosen/export-excel', [DosenController::class, 'exportDosenExcel'])->name('dosen.export.excel');
            Route::post('/dosen/import-excel', [DosenController::class, 'importDosenExcel'])->name('dosen.import.excel');
            Route::get('/dosen/export-pdf', [DosenController::class, 'exportDosenPdf'])->name('dosen.export.pdf');
            // Resource ditaruh paling bawah di modulnya
            Route::resource('dosen', DosenController::class);


            // ================= MODUL MAHASISWA =================
            Route::get('/mahasiswa/export-excel', [MahasiswaController::class, 'exportMahasiswaExcel'])->name('mahasiswa.export.excel');
            Route::post('/mahasiswa/import-excel', [MahasiswaController::class, 'importMahasiswaExcel'])->name('mahasiswa.import.excel');
            Route::get('/mahasiswa/export-pdf', [MahasiswaController::class, 'exportMahasiswaPdf'])->name('mahasiswa.export.pdf');
            // Rute kustom reset-password ditaruh di sini (di atas resource)
            Route::post('/mahasiswa/{id}/reset-password', [MahasiswaController::class, 'resetPassword'])->name('mahasiswa.reset-password');
            // Resource ditaruh paling bawah di modulnya
            Route::resource('mahasiswa', MahasiswaController::class);


            // ================= MODUL MATA KULIAH =================
            Route::get('/matakuliah/export-excel', [MatakuliahController::class, 'exportMatakuliahExcel'])->name('matakuliah.export.excel');
            Route::post('/matakuliah/import-excel', [MatakuliahController::class, 'importMatakuliahExcel'])->name('matakuliah.import.excel');
            Route::get('/matakuliah/export-pdf', [MatakuliahController::class, 'exportMatakuliahPdf'])->name('matakuliah.export.pdf');
            // Resource ditaruh paling bawah di modulnya
            Route::resource('matakuliah', MatakuliahController::class);


            // ================= MODUL JADWAL =================
            Route::get('/jadwal/export-excel', [JadwalController::class, 'exportJadwalExcel'])->name('jadwal.export.excel');
            Route::post('/jadwal/import-excel', [JadwalController::class, 'importJadwalExcel'])->name('jadwal.import.excel');
            Route::get('/jadwal/export-pdf', [JadwalController::class, 'exportJadwalPdf'])->name('jadwal.export.pdf');
            // Resource ditaruh paling bawah di modulnya
            Route::resource('jadwal', JadwalController::class);
        });

    /*
    |-- Mahasiswa Area
    */
    Route::middleware('role:mahasiswa')
        ->prefix('mahasiswa')
        ->name('mahasiswa.')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::prefix('krs')->name('krs.')->group(function () {
                Route::get('/', [KrsController::class, 'index'])->name('index');
                Route::post('/submit', [KrsController::class, 'store'])->name('store');
                Route::post('/cancel', [KrsController::class, 'cancel'])->name('cancel');
                Route::get('/print', [KrsController::class, 'print'])->name('print');
            });

            Route::prefix('classroom')->name('classroom.')->group(function () {
                Route::get('/', [MhsClassroomController::class, 'index'])->name('index');
                Route::get('/course/{id}', [MhsClassroomController::class, 'show'])->name('show');
                Route::post('/pertemuan/{pertemuanId}/absensi', [MhsClassroomController::class, 'storeAbsensi'])->name('absensi.store');
                Route::post('/tugas/{tugasId}/submit', [MhsClassroomController::class, 'submitTugas'])->name('tugas.submit');
                Route::put('/tugas/{id}', [TugasSubmissionController::class, 'update'])->name('tugas.update');
                Route::delete('/tugas/{id}', [TugasSubmissionController::class, 'destroy'])->name('tugas.destroy');
            });
        });

    /*
    |-- Dosen Area
    */
    Route::middleware('role:dosen')
        ->prefix('dosen')
        ->name('dosen.')
        ->group(function () {
            Route::get('/dashboard', [DosenDashboardController::class, 'index'])->name('dashboard');

            Route::prefix('krs-approval')->name('krs.')->group(function () {
                Route::get('/', [DosenKrsController::class, 'index'])->name('index');
                Route::post('/{npm}/verify', [DosenKrsController::class, 'verifikasi'])->name('verifikasi');
            });

            Route::prefix('classroom')->name('classroom.')->group(function () {
                Route::get('/', [ClassroomController::class, 'index'])->name('index');
                Route::get('/course/{id}', [ClassroomController::class, 'show'])->name('show');
                Route::post('/course/{jadwalId}/pertemuan', [ClassroomController::class, 'storePertemuan'])->name('pertemuan.store');
                Route::post('/pertemuan/{pertemuanId}/materi', [ClassroomController::class, 'storeMateri'])->name('materi.store');
                Route::post('/pertemuan/{pertemuanId}/tugas', [ClassroomController::class, 'storeTugas'])->name('tugas.store');
                Route::post('/submission/{submissionId}/nilai', [ClassroomController::class, 'gradeTugas'])->name('tugas.grade');
                Route::post('/pertemuan/{id}/toggle-absensi', [ClassroomController::class, 'toggleAbsensi'])->name('pertemuan.toggleAbsensi');
            });
        });
});
