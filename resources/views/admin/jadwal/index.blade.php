@extends('layouts.app')

@section('title', 'Kelola Jadwal Kuliah')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">
@endsection


@section('sidebar-menu')
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
        <i class="fas fa-th-large mr-3 w-5 text-center"></i> Dashboard
    </a>
    <a href="{{ route('admin.dosen.index') }}"
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
        <i class="fas fa-chalkboard-user mr-3 w-5 text-center"></i> Data Dosen
    </a>
    <a href="{{ route('admin.mahasiswa.index') }}"
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
        <i class="fas fa-user-graduate mr-3 w-5 text-center"></i> Data Mahasiswa
    </a>
    <a href="{{ route('admin.matakuliah.index') }}"
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
        <i class="fas fa-book mr-3 w-5 text-center"></i> Mata Kuliah
    </a>
    <a href="{{ route('admin.jadwal.index') }}"
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg shadow-indigo-900/30">
        <i class="fas fa-calendar-alt mr-3 w-5 text-center"></i> Jadwal Kuliah
    </a>
@endsection

@section('content')
    <div class="space-y-6 md:space-y-8">

        {{-- ================= HEADER ================= --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl shadow-2xl border border-white/10 transition-all duration-300 hover:shadow-indigo-900/30">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>

            <div class="relative p-6 sm:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                    <div class="space-y-3">
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-indigo-500/20 text-indigo-300 rounded-full border border-indigo-500/30 backdrop-blur-sm">
                                <i class="fas fa-calendar-alt text-[8px]"></i> Manajemen Jadwal
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                                <i class="fas fa-clock text-[8px]"></i> {{ $jadwals->total() }} Total Jadwal
                            </span>
                        </div>
                        
                        <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">
                            Jadwal Perkuliahan
                        </h1>
                        
                        <p class="text-xs md:text-sm text-slate-300 font-medium max-w-2xl">
                            Atur sinkronisasi data relasi antara angkatan, semester, kelas, mata kuliah, hari, dan dosen pengajar.
                        </p>
                    </div>
                    
                    <div>
                        <a href="{{ route('admin.jadwal.create') }}"
                            class="group inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-900/30 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                            <i class="fas fa-plus text-xs group-hover:rotate-90 transition-transform duration-300"></i>
                            Tambah Jadwal
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= ALERTS ================= --}}
        @if (session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl text-sm font-medium text-emerald-800 flex items-center gap-3 animate-slide-in">
                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-emerald-600"></i>
                </div>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl text-sm font-medium text-rose-800 animate-slide-in">
                <div class="flex items-center gap-2.5 mb-2">
                    <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-rose-600"></i>
                    </div>
                    <span class="font-bold">Proses Gagal!</span>
                </div>
                <ul class="list-disc pl-12 space-y-0.5">
                    @if(session('error')) <li>{{ session('error') }}</li> @endif
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
@endforeach
                </ul>
            </div>
        @endif

        {{-- ================= ACTION TOOLBAR ================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('admin.jadwal.export.excel', ['hari' => request('hari')]) }}" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                        <i class="fas fa-file-excel text-sm"></i> Export Excel
                    </a>
                    
                    <a href="{{ route('admin.jadwal.export.pdf', ['hari' => request('hari')]) }}" target="_blank" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                        <i class="fas fa-file-pdf text-sm"></i> Export PDF
                    </a>
                </div>

                <form action="{{ route('admin.jadwal.import.excel') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-2">
                    @csrf
                    <input type="file" name="file" required 
                        class="text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer transition-all">
                    <button type="submit" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                        <i class="fas fa-upload text-xs"></i> Import Jadwal
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= SEARCH BAR ================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
            <form action="{{ route('admin.jadwal.index') }}" method="GET" class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fas fa-search text-sm"></i>
                </div>
                <input type="text" name="search" value="{{ $search }}" 
                    placeholder="Cari berdasarkan Nama Mata Kuliah atau Dosen..."
                    class="w-full pl-11 pr-24 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all bg-white">
                @if ($search)
                    <a href="{{ route('admin.jadwal.index') }}" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 px-3 py-1 text-xs text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all">
                        <i class="fas fa-times mr-1"></i> Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- ================= TABEL JADWAL ================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
            
            <div class="px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-indigo-600 text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Daftar Jadwal Kuliah</h2>
                        <p class="text-[10px] text-slate-400">Menampilkan {{ $jadwals->firstItem() }} - {{ $jadwals->lastItem() }} dari {{ $jadwals->total() }} jadwal</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1200px]">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-5 py-3 text-center w-16">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">No</span>
                            </th>
                            <th class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Mata Kuliah</span>
                            </th>
                            <th class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Dosen Pengajar</span>
                            </th>
                            <th class="px-5 py-3 text-center">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Semester</span>
                            </th>
                            <th class="px-5 py-3 text-center">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Angkatan</span>
                            </th>
                            <th class="px-5 py-3 text-center">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Kelas</span>
                            </th>
                            <th class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Waktu</span>
                            </th>
                            <th class="px-5 py-3 text-center w-40">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($jadwals as $index => $jdw)
                            @php
                                $tahunAngkatan = 2026 - ceil($jdw->matakuliah->semester / 2);
                            @endphp
                            <tr class="group hover:bg-indigo-50/30 transition-all duration-200">
                                <td class="px-5 py-3 text-center">
                                    <span class="text-xs text-slate-500 font-medium">{{ $jadwals->firstItem() + $index }}</span>
                                </td>
                                
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-book text-indigo-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800">{{ $jdw->matakuliah->nama_matakuliah }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono">{{ $jdw->kode_matakuliah }} • {{ $jdw->matakuliah->sks }} SKS</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                            <i class="fas fa-user-tie text-emerald-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800">{{ $jdw->dosen->nama }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono">NIDN: {{ $jdw->nidn }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 text-xs font-bold">
                                        Semester {{ $jdw->matakuliah->semester }}
                                    </span>
                                </td>

                                <td class="px-5 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-cyan-50 text-cyan-700 text-xs font-bold">
                                        {{ $tahunAngkatan }}
                                    </span>
                                </td>

                                <td class="px-5 py-3 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">
                                        <i class="fas fa-users mr-1 text-[9px]"></i> Kelas {{ $jdw->kelas }}
                                    </span>
                                </td>

                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center">
                                            <i class="far fa-calendar-alt text-amber-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800">{{ $jdw->hari }}</p>
                                            <p class="text-[10px] text-slate-500 font-mono">
                                                {{ date('H:i', strtotime($jdw->jam_mulai)) }} - {{ date('H:i', strtotime($jdw->jam_selesai)) }} WIB
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.jadwal.edit', $jdw->id) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-500 hover:text-white border border-amber-200 transition-all duration-200 text-xs font-semibold">
                                            <i class="fas fa-edit text-xs"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.jadwal.destroy', $jdw->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal kuliah ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-500 hover:text-white border border-rose-200 transition-all duration-200 text-xs font-semibold">
                                                <i class="fas fa-trash text-xs"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 rounded-2xl bg-slate-50 flex items-center justify-center mb-4">
                                            <i class="fas fa-calendar-times text-3xl text-slate-300"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-500">Tidak ada jadwal perkuliahan ditemukan</p>
                                        <p class="text-[11px] text-slate-400 mt-1">Silakan tambah jadwal baru</p>
                                        <a href="{{ route('admin.jadwal.create') }}" 
                                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition-all">
                                            <i class="fas fa-plus"></i> Tambah Jadwal
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($jadwals->hasPages())
                <div class="px-5 py-3 bg-slate-50 border-t border-slate-100">
                    {{ $jadwals->links() }}
                </div>
            @endif
        </div>

        {{-- ================= INFORMASI TAMBAHAN ================= --}}
        @if($jadwals->count() > 0)
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-5 border border-indigo-100">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-info-circle text-indigo-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Informasi Jadwal</p>
                        <p class="text-xs text-slate-500">Total {{ $jadwals->total() }} jadwal perkuliahan terdaftar</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3 text-xs text-slate-500">
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                        <span>Perkuliahan Reguler</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <span>Jadwal Aktif</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>


@endsection