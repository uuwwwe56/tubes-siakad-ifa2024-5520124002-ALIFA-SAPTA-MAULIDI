@extends('layouts.app')

@section('title', 'Tambah Jadwal Kuliah')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Buat Jadwal Kuliah Baru</h1>
                <p class="text-sm text-slate-500 mt-1">Relasikan mata kuliah ke kelas paralel dan tautkan dosen pengajarnya.</p>
            </div>
            <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pilih Mata Kuliah</label>
                    <select name="kode_matakuliah" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                        <option value="">-- Pilih Mata Kuliah Kurikulum --</option>
                        @foreach($matakuliahs as $mk)
                            <option value="{{ $mk->kode_matakuliah }}">{{ $mk->nama_matakuliah }} (Sem. {{ $mk->semester }} - {{ $mk->kode_matakuliah }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Dosen Pengampu</label>
                    <select name="nidn" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                        <option value="">-- Pilih Dosen Pengajar --</option>
                        @foreach($dosens as $dsn)
                            <option value="{{ $dsn->nidn }}">{{ $dsn->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Hari Kuliah</label>
                        <select name="hari" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alokasi Kelas Paralel</label>
                        <select name="kelas" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white">
                            <option value="A">Kelas A</option>
                            <option value="B">Kelas B</option>
                            <option value="C">Kelas C</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jam Mulai Perkuliahan</label>
                        <input type="time" name="jam_mulai" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jam Selesai Perkuliahan</label>
                        <input type="time" name="jam_selesai" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-xl transition-all shadow-md text-sm">
                        <i class="fas fa-calendar-plus mr-2"></i> Daftarkan Jadwal Resmi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection