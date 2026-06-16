@extends('layouts.app')

@section('title', 'Kartu Rencana Studi (KRS) - SIAKAD')

@section('sidebar-menu')
    <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-colors">
        <i class="fas fa-th-large mr-3 w-5 text-center"></i> Dashboard
    </a>
    <a href="{{ route('mahasiswa.krs.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl bg-indigo-600 text-white">
        <i class="fas fa-file-alt mr-3 w-5 text-center"></i> Pengisian KRS
    </a>
@endsection

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pengisian Kartu Rencana Studi (KRS)</h1>
        <p class="text-sm text-slate-500 mt-1">Pilih mata kuliah kurikulum aktif di bawah ini untuk didaftarkan ke dalam rencana studi Anda.</p>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
            <span class="text-sm font-medium text-emerald-800">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-rose-500 mr-3"></i>
            <span class="text-sm font-medium text-rose-800">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider"><i class="fas fa-plus-circle text-indigo-500 mr-1.5"></i> Ambil Mata Kuliah Baru</h2>
        <form action="{{ route('mahasiswa.krs.store') }}" method="POST" class="flex flex-col sm:flex-row items-end sm:items-center gap-4">
            @csrf
            <div class="w-full flex-1">
                <select name="kode_matakuliah" class="w-full px-4 py-2.5 border @error('kode_matakuliah') border-red-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-white transition-all">
                    <option value="">-- Pilih Mata Kuliah yang Tersedia --</option>
                    @foreach($matakuliah_tersedia as $mk)
                        <option value="{{ $mk->kode_matakuliah }}">
                            {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }} • {{ $mk->sks }} SKS)
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition-all whitespace-nowrap">
                <i class="fas fa-check mr-1.5"></i> Daftarkan Mata Kuliah
            </button>
        </form>
    </div>

    <div class="space-y-3">
        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider"><i class="fas fa-list text-slate-500 mr-1.5"></i> Ringkasan KRS Terdaftar</h2>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider">
                            <th class="px-6 py-4 text-center w-16">No</th>
                            <th class="px-6 py-4 w-32">Kode MK</th>
                            <th class="px-6 py-4">Nama Mata Kuliah</th>
                            <th class="px-6 py-4 text-center w-32">Bobot SKS</th>
                            <th class="px-6 py-4 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                        @forelse($krs_diambil as $index => $krs)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-mono font-bold text-xs text-slate-900 uppercase">{{ $krs->kode_matakuliah }}</td>
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $krs->matakuliah->nama_matakuliah }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-indigo-50 text-indigo-700 rounded-lg border border-indigo-100">
                                    {{ $krs->matakuliah->sks }} SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('mahasiswa.krs.destroy', $krs->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan (drop) mata kuliah ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg border border-rose-200 transition-all shadow-sm">
                                        <i class="fas fa-trash-alt mr-1"></i> Drop
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <i class="fas fa-folder-open text-3xl mb-3 block"></i>
                                Belum ada mata kuliah yang diambil dalam rencana studi Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="space-y-3">
        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider"><i class="fas fa-calendar-alt text-slate-500 mr-1.5"></i> Kalender Jadwal Kuliah Anda</h2>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider">
                            <th class="px-6 py-4 w-32">Hari</th>
                            <th class="px-6 py-4 w-32">Jam</th>
                            <th class="px-6 py-4 text-center w-20">Kelas</th>
                            <th class="px-6 py-4">Mata Kuliah</th>
                            <th class="px-6 py-4">Dosen Pengampu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                        @forelse($jadwals as $jdw)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-800">{{ $jdw->hari }}</td>
                            <td class="px-6 py-4 font-medium text-slate-600">{{ date('H:i', strtotime($jdw->jam)) }} WIB</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-0.5 text-xs font-bold bg-slate-100 text-slate-700 rounded border uppercase">{{ $jdw->kelas }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $jdw->matakuliah->nama_matakuliah }}</div>
                                <div class="text-xs text-slate-400 font-mono">{{ $jdw->kode_matakuliah }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-500">{{ $jdw->dosen->nama }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                                Jadwal kuliah otomatis terisi setelah Anda memilih mata kuliah di atas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection