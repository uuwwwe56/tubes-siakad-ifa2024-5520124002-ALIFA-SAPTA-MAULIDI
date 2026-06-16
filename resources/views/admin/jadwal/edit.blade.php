@extends('layouts.app')

@section('title', 'Edit Jadwal Kuliah')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('admin.jadwal.index') }}"
           class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Jadwal
        </a>

        <div class="mt-3">
            <h1 class="text-3xl font-bold text-slate-800">
                Edit Jadwal Kuliah
            </h1>
            <p class="text-slate-500 mt-1">
                Perbarui informasi mata kuliah, dosen, hari dan jam perkuliahan.
            </p>
        </div>
    </div>

    {{-- Card --}}
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-slate-200">

        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
            <h2 class="text-white font-semibold text-lg">
                <i class="fas fa-calendar-alt mr-2"></i>
                Form Edit Jadwal
            </h2>
        </div>

        <form action="{{ route('admin.jadwal.update',$jadwal->id) }}"
              method="POST"
              class="p-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Mata Kuliah --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Mata Kuliah
                    </label>

                    <select name="kode_matakuliah"
                            class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($matakuliahs as $mk)
                            <option value="{{ $mk->kode_matakuliah }}"
                                {{ old('kode_matakuliah',$jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>
                                {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}
                            </option>
                        @endforeach
                    </select>

                    @error('kode_matakuliah')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Dosen --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Dosen Pengajar
                    </label>

                    <select name="nidn"
                            class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->nidn }}"
                                {{ old('nidn',$jadwal->nidn) == $dosen->nidn ? 'selected' : '' }}>
                                {{ $dosen->nidn }} - {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>

                    @error('nidn')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Kelas --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Kelas
                    </label>

                    <input type="text"
                           name="kelas"
                           maxlength="1"
                           value="{{ old('kelas',$jadwal->kelas) }}"
                           class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Hari --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Hari
                    </label>

                    <select name="hari"
                            class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">

                        @foreach($haris as $hari)
                            <option value="{{ $hari }}"
                                {{ old('hari',$jadwal->hari) == $hari ? 'selected' : '' }}>
                                {{ $hari }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Jam Mulai --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Jam Mulai
                    </label>

                    <input type="time"
                           name="jam_mulai"
                           value="{{ old('jam_mulai', substr($jadwal->jam_mulai,0,5)) }}"
                           class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Jam Selesai --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Jam Selesai
                    </label>

                    <input type="time"
                           name="jam_selesai"
                           value="{{ old('jam_selesai', substr($jadwal->jam_selesai,0,5)) }}"
                           class="w-full rounded-xl border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

            </div>

            {{-- Footer --}}
            <div class="mt-8 pt-5 border-t flex justify-end gap-3">

                <a href="{{ route('admin.jadwal.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 shadow">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>
    </div>
</div>
@endsection