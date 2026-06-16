@extends('layouts.app')

@section('title', 'Tambah Data Dosen')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.dosen.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight mt-2">Tambah Dosen Baru</h1>
        <p class="text-sm text-slate-500 mt-1">Masukkan informasi data dosen pengajar secara valid.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.dosen.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIDN (Nomor Induk Dosen Nasional)</label>
                <input type="text" name="nidn" value="{{ old('nidn') }}" maxlength="10" placeholder="Contoh: 0412038901" class="w-full px-4 py-2.5 border @error('nidn') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                @error('nidn')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap & Gelar</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Dr. Randi Julianto, M.T." class="w-full px-4 py-2.5 border @error('nama') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.dosen.index') }}" class="px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition-all">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection