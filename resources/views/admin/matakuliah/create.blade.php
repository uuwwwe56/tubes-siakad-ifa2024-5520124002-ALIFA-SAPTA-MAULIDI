@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.matakuliah.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight mt-2">Tambah Mata Kuliah Baru</h1>
        <p class="text-sm text-slate-500 mt-1">Masukkan data kurikulum mata kuliah dengan kode unik 8 karakter.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.matakuliah.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kode Mata Kuliah (Harus 8 Karakter)</label>
                <input type="text" name="kode_matakuliah" value="{{ old('kode_matakuliah') }}" maxlength="8" placeholder="Contoh: IF53413" class="w-full px-4 py-2.5 border @error('kode_matakuliah') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm font-mono focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all uppercase">
                @error('kode_matakuliah')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}" placeholder="Contoh: Pemrograman Web II" class="w-full px-4 py-2.5 border @error('nama_matakuliah') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                @error('nama_matakuliah')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Bobot SKS</label>
                <select name="sks" class="w-full px-4 py-2.5 border @error('sks') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all bg-white">
                    <option value="">-- Pilih Jumlah SKS --</option>
                    @for($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ old('sks') == $i ? 'selected' : '' }}>{{ $i }} SKS</option>
                    @endfor
                </select>
                @error('sks')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.matakuliah.index') }}" class="px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition-all">
                    Simpan Kurikulum
                </button>
            </div>
        </form>
    </div>
</div>
@endsection