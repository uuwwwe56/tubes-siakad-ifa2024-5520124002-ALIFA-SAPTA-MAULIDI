@extends('layouts.app')

@section('title', 'Dashboard Dosen')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashDosen.css') }}">
@endsection
@section('content')
<div class="space-y-6 md:space-y-8">

    {{-- ================= HEADER DASHBOARD ================= --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl shadow-2xl border border-white/10 transition-all duration-300 hover:shadow-indigo-900/30">
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>

        <div class="relative p-6 sm:p-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-5">
                <div class="space-y-3">
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-indigo-500/20 text-indigo-300 rounded-full border border-indigo-500/30 backdrop-blur-sm">
                            <i class="fas fa-chalkboard-user text-[8px]"></i> Dosen Wali
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                            <i class="fas fa-check-circle text-[8px]"></i> Aktif
                        </span>
                    </div>
                    
                    <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">
                        Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">{{ $dosen->nama }}</span>
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/5 rounded-xl border border-white/10 backdrop-blur-sm">
                            <i class="fas fa-id-card text-indigo-400 text-xs"></i>
                            <span class="text-sm text-slate-300">NIDN: {{ $dosen->nidn ?? '-' }}</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/5 rounded-xl border border-white/10 backdrop-blur-sm">
                            <i class="fas fa-envelope text-indigo-400 text-xs"></i>
                            <span class="text-sm text-slate-300">{{ $dosen->email ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 px-4 py-2 bg-white/5 rounded-2xl border border-white/10 backdrop-blur-sm">
                    <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-indigo-400 text-xs"></i>
                    </div>
                    <span class="text-sm font-medium text-white">{{ date('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= GRID KARTU STATISTIK ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">

        {{-- Total Mahasiswa Bimbingan --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-users text-[9px]"></i> Mahasiswa Bimbingan
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight pt-1">
                            {{ $totalMahasiswa }}
                        </h2>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-indigo-500 to-indigo-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

        {{-- Menunggu Persetujuan --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-clock text-[9px]"></i> Menunggu Persetujuan
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-amber-600 tracking-tight pt-1">
                            {{ $menunggu }}
                        </h2>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-hourglass-half text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-amber-500 to-amber-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

        {{-- Disetujui --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-check-circle text-[9px]"></i> Disetujui
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-emerald-600 tracking-tight pt-1">
                            {{ $disetujui }}
                        </h2>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-check-double text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-emerald-500 to-emerald-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

        {{-- Ditolak --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-times-circle text-[9px]"></i> Ditolak
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-rose-600 tracking-tight pt-1">
                            {{ $ditolak }}
                        </h2>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-rose-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-ban text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-rose-500 to-rose-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

    </div>

    {{-- ================= TABEL PENGAJUAN KRS ================= --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
        
        <div class="px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <div class="w-1 h-7 bg-gradient-to-b from-indigo-600 to-purple-600 rounded-full"></div>
                <div>
                    <h2 class="font-bold text-slate-800 text-base md:text-lg">
                        Pengajuan KRS Terbaru
                    </h2>
                    <p class="text-[10px] text-slate-400">Data real-time pengajuan Kartu Rencana Studi</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-700 font-semibold text-[10px] rounded-full border border-indigo-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                    Data Real-time
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-5 py-3 text-left">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Mahasiswa</span>
                        </th>
                        <th class="px-5 py-3 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">NPM</span>
                        </th>
                        <th class="px-5 py-3 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Status</span>
                        </th>
                        <th class="px-5 py-3 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Aksi</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-50">
                    @forelse($pengajuanTerbaru as $mhs)
                        @php
                            $status = $mhs->krs->first()->status ?? 'Belum Mengisi';
                            $statusLower = strtolower($status);
                        @endphp

                        <tr class="group hover:bg-indigo-50/30 transition-all duration-200">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center font-bold text-xs text-indigo-700 border border-indigo-200 shadow-sm">
                                            {{ substr($mhs->nama, 0, 2) }}
                                        </div>
                                        @if($statusLower == 'menunggu persetujuan')
                                            <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-amber-500 border-2 border-white"></span>
                                        @elseif($statusLower == 'disetujui')
                                            <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-emerald-500 border-2 border-white"></span>
                                        @elseif($statusLower == 'ditolak')
                                            <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-rose-500 border-2 border-white"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800 text-sm">{{ $mhs->nama }}</p>
                                        <p class="text-[10px] text-slate-400">Kelas {{ $mhs->kelas ?? '-' }}</p>
                                    </div>
                                </div>
                             </td>
                            <td class="px-5 py-3 text-center">
                                <span class="font-mono text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-lg">{{ $mhs->npm }}</span>
                             </td>
                            <td class="px-5 py-3 text-center">
                                @php
                                    $statusConfig = [
                                        'disetujui' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'icon' => 'fa-check-circle', 'label' => 'Disetujui'],
                                        'menunggu persetujuan' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'icon' => 'fa-clock', 'label' => 'Menunggu'],
                                        'ditolak' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'icon' => 'fa-times-circle', 'label' => 'Ditolak'],
                                        'belum mengisi' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'icon' => 'fa-edit', 'label' => 'Belum Isi'],
                                    ];
                                    $config = $statusConfig[$statusLower] ?? $statusConfig['belum mengisi'];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold {{ $config['bg'] }} {{ $config['text'] }} border {{ $config['border'] }}">
                                    <i class="fas {{ $config['icon'] }} text-[10px]"></i>
                                    {{ $config['label'] }}
                                </span>
                             </td>
                            <td class="px-5 py-3 text-center">
                                @if($statusLower == 'menunggu persetujuan')
                                    <a href="{{ route('dosen.krs.show', $mhs->id) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-[11px] rounded-lg transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                        <i class="fas fa-eye text-[10px]"></i> Review
                                    </a>
                                @elseif($statusLower == 'disetujui')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[11px] font-medium rounded-lg">
                                        <i class="fas fa-check"></i> Selesai
                                    </span>
                                @elseif($statusLower == 'ditolak')
                                    <a href="{{ route('dosen.krs.show', $mhs->id) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold text-[11px] rounded-lg transition-all duration-200">
                                        <i class="fas fa-redo-alt text-[10px]"></i> Lihat
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-400 text-[11px] font-medium rounded-lg">
                                        <i class="fas fa-clock"></i> Menunggu
                                    </span>
                                @endif
                             </td>
                         </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-14 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mb-3">
                                        <i class="fas fa-inbox text-2xl text-slate-300"></i>
                                    </div>
                                    <p class="text-sm font-medium text-slate-500">Belum ada data pengajuan KRS masuk</p>
                                    <p class="text-[11px] text-slate-400 mt-1">Semua mahasiswa bimbingan Anda belum mengisi KRS</p>
                                </div>
                             </td>
                         </tr>
                    @endforelse
                </tbody>
             </table>
        </div>

        @if($pengajuanTerbaru->count() > 0)
        <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 flex justify-end">
            <a href="{{ route('dosen.krs.index') }}" 
               class="inline-flex items-center gap-1 text-xs text-indigo-600 hover:text-indigo-700 font-semibold transition-colors">
                Lihat semua pengajuan
                <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
        @endif
    </div>

</div>


@endsection