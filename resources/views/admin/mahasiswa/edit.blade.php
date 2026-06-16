@extends('layouts.app')

@section('title', 'Edit Data Mahasiswa')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.mahasiswa.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight mt-2">Edit Data Mahasiswa</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui biodata, status semester aktif, kelas paralel, atau sesuaikan dosen wali akademik.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->npm) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">NPM (Tidak Dapat Diubah)</label>
                <input type="text" value="{{ $mahasiswa->npm }}" disabled class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-400 rounded-xl text-sm font-mono cursor-not-allowed">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap Mahasiswa</label>
                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="w-full px-4 py-2.5 border @error('nama') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tahun Angkatan</label>
                    <select name="angkatan" class="w-full px-4 py-2.5 border @error('angkatan') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all bg-white">
                        @for ($year = 2022; $year <= 2026; $year++)
                            <option value="{{ $year }}" {{ old('angkatan', $mahasiswa->angkatan) == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    @error('angkatan')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Semester Aktif</label>
                    <select name="semester_aktif" class="w-full px-4 py-2.5 border @error('semester_aktif') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all bg-white">
                        @for ($s = 1; $s <= 8; $s++)
                            <option value="{{ $s }}" {{ old('semester_aktif', $mahasiswa->semester_aktif) == $s ? 'selected' : '' }}>
                                Semester {{ $s }}
                            </option>
                        @endfor
                    </select>
                    @error('semester_aktif')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kelas Paralel</label>
                    <select name="kelas" class="w-full px-4 py-2.5 border @error('kelas') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all bg-white">
                        @foreach (['A', 'B', 'C'] as $k)
                            <option value="{{ $k }}" {{ old('kelas', $mahasiswa->kelas) == $k ? 'selected' : '' }}>
                                Kelas {{ $k }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Dosen Wali</label>
                <select name="nidn" class="w-full px-4 py-2.5 border @error('nidn') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all bg-white">
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nama }} (NIDN. {{ $dosen->nidn }})
                        </option>
                    @endforeach
                </select>
                @error('nidn')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.mahasiswa.index') }}" class="px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition-all">
                    <i class="fas fa-save mr-1.5"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection