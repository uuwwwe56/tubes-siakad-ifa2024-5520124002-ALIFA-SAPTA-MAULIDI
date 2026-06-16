@extends('layouts.app')

@section('title', 'Tambah Data Mahasiswa')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Mahasiswa Baru</h1>
                <p class="text-sm text-slate-500 mt-1">Akun login pengguna (User) otomatis akan dibuat menggunakan nomor NPM sebagai username.</p>
            </div>
            <a href="{{ route('admin.mahasiswa.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Pokok Mahasiswa (NPM)</label>
                    <input type="text" name="npm" required placeholder="Contoh: 24534001" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Nama lengkap beserta gelar (jika ada)" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tahun Angkatan</label>
                        <select name="angkatan" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                            <option value="2024" selected>2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Semester Aktif</label>
                        <select name="semester_aktif" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                            @for ($s = 1; $s <= 8; $s++)
                                <option value="{{ $s }}">Semester {{ $s }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kelas Paralel</label>
                        <select name="kelas" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                            <option value="A" selected>Kelas A</option>
                            <option value="B">Kelas B</option>
                            <option value="C">Kelas C</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Dosen Wali (Pembimbing Akademik)</label>
                    <select name="nidn" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                        <option value="">-- Pilih Dosen Pengampu --</option>
                        @foreach($dosens as $dsn)
                            <option value="{{ $dsn->nidn }}">{{ $dsn->nama }} (NIDN. {{ $dsn->nidn }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-xl transition-all shadow-md text-sm">
                        <i class="fas fa-save mr-2"></i> Simpan Data Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection