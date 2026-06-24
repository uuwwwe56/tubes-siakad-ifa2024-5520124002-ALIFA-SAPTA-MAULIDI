@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashMhs.css') }}">
@endsection
@section('content')
<div class="space-y-6 md:space-y-8">
    
    {{-- ================= GREETING + PROFILE CARD ================= --}}
    <div
        class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl shadow-2xl border border-white/10 transition-all duration-300 hover:shadow-indigo-900/30">
        
        {{-- Decorative Glow Blobs --}}
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>
        
        <div class="relative p-6 sm:p-8 md:p-10">
            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-8">
                
                {{-- Avatar dengan efek ring --}}
                <div class="relative group">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 blur-lg opacity-50 group-hover:opacity-75 transition-opacity duration-300"></div>
                    <div class="relative w-24 h-24 md:w-28 md:h-28 rounded-2xl overflow-hidden bg-slate-800 border-2 border-white/20 shadow-2xl flex items-center justify-center">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-indigo-600 to-purple-600 flex items-center justify-center text-white text-4xl font-black transition-transform duration-300 group-hover:scale-105">
                                {{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center md:text-left space-y-3 flex-1">
                    {{-- Status Badge --}}
                    <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Perkuliahan Aktif
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-indigo-500/20 text-indigo-300 rounded-full border border-indigo-500/30 backdrop-blur-sm">
                            <i class="fas fa-calendar-alt text-[8px]"></i>
                            Semester {{ $mahasiswa->semester_aktif ?? 'Ganjil' }} {{ date('Y') }}
                        </span>
                    </div>
                    
                    <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">
                        Selamat Datang, {{ $mahasiswa->nama }}! 👋
                    </h1>
                    
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                        <p class="text-xs md:text-sm text-slate-300 font-medium flex items-center gap-2">
                            <i class="fas fa-id-card text-indigo-400 text-xs"></i>
                            <span class="font-mono bg-slate-800/50 px-2 py-1 rounded-lg text-indigo-300 font-bold border border-slate-700/50">{{ $mahasiswa->npm }}</span>
                        </p>
                        <p class="text-xs md:text-sm text-slate-300 font-medium flex items-center gap-2">
                            <i class="fas fa-graduation-cap text-indigo-400 text-xs"></i>
                            Teknik Informatika
                        </p>
                        <p class="text-xs md:text-sm text-slate-300 font-medium flex items-center gap-2">
                            <i class="fas fa-chalkboard-user text-indigo-400 text-xs"></i>
                            Dosen Wali: <span class="text-white font-semibold">{{ $mahasiswa->dosenWali->nama ?? 'Belum Ditentukan' }}</span>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= STATS GRID ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
        
        {{-- SKS Card --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-layer-group text-white text-lg"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full {{ $totalSks >= 24 ? 'bg-rose-100 text-rose-700' : 'bg-indigo-100 text-indigo-700' }}">
                        {{ $totalSks >= 24 ? 'Maksimal' : 'Beban SKS' }}
                    </span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Beban SKS Diambil</p>
                <p class="text-4xl font-black text-slate-800 tracking-tight">
                    {{ $totalSks }} <span class="text-base font-bold text-slate-400">/ 24 SKS</span>
                </p>
            </div>
            <div class="px-6 pb-6">
                <div class="relative h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full transition-all duration-700 ease-out group-hover:from-indigo-600 group-hover:to-indigo-700"
                        style="width: {{ min(100, ($totalSks / 24) * 100) }}%">
                    </div>
                </div>
                <p class="text-[10px] text-slate-400 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ $totalSks >= 24 ? 'Beban SKS sudah maksimal' : 'Sisa ' . (24 - $totalSks) . ' SKS dapat diambil' }}
                </p>
            </div>
        </div>

        {{-- Mata Kuliah Card --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-lg shadow-violet-500/20 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book-open text-white text-lg"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full bg-violet-100 text-violet-700">
                        Classroom
                    </span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Mata Kuliah Aktif</p>
                <p class="text-4xl font-black text-slate-800 tracking-tight">
                    {{ $jumlahMk }} <span class="text-base font-bold text-slate-400">Mata Kuliah</span>
                </p>
            </div>
            <div class="px-6 pb-6">
                <div class="flex items-center gap-2 text-[11px] text-slate-500">
                    <i class="fas fa-clock text-slate-400"></i>
                    <span>Terdaftar di ruang kelas digital</span>
                </div>
                <a href="{{ route('mahasiswa.classroom.index') }}" 
                   class="mt-3 inline-flex items-center gap-1 text-xs text-indigo-600 hover:text-indigo-700 font-medium group/link">
                    Lihat jadwal kuliah
                    <i class="fas fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        {{-- KRS Status Card --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 overflow-hidden sm:col-span-2 lg:col-span-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-clipboard-list text-white text-lg"></i>
                    </div>
                    @php
                        $statusKrsClean = strtolower((string) ($statusKrs ?? 'belum'));

                        $statusMap = [
                            'approved' => ['label' => 'Disetujui', 'badge' => 'bg-emerald-100 text-emerald-700', 'icon' => 'fa-check-circle'],
                            'disetujui' => ['label' => 'Disetujui', 'badge' => 'bg-emerald-100 text-emerald-700', 'icon' => 'fa-check-circle'],
                            'pending' => ['label' => 'Menunggu', 'badge' => 'bg-amber-100 text-amber-700', 'icon' => 'fa-clock'],
                            'menunggu' => ['label' => 'Menunggu', 'badge' => 'bg-amber-100 text-amber-700', 'icon' => 'fa-clock'],
                            'rejected' => ['label' => 'Ditolak', 'badge' => 'bg-rose-100 text-rose-700', 'icon' => 'fa-times-circle'],
                            'ditolak' => ['label' => 'Ditolak', 'badge' => 'bg-rose-100 text-rose-700', 'icon' => 'fa-times-circle'],
                            'belum' => ['label' => 'Belum Isi', 'badge' => 'bg-slate-100 text-slate-600', 'icon' => 'fa-edit'],
                        ];

                        $statusInfo = $statusMap[$statusKrsClean] ?? [
                            'label' => ucfirst($statusKrsClean),
                            'badge' => 'bg-slate-100 text-slate-600',
                            'icon' => 'fa-question-circle',
                        ];
                    @endphp
                    <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full {{ $statusInfo['badge'] }}">
                        <i class="fas {{ $statusInfo['icon'] }} mr-1 text-[8px]"></i>
                        {{ $statusInfo['label'] }}
                    </span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Status Rencana Studi</p>
                <p class="text-4xl font-black text-slate-800 tracking-tight">
                    Semester {{ $mahasiswa->semester_aktif ?? 'Ganjil' }}
                </p>
            </div>
            <div class="px-6 pb-6">
                <div class="flex items-center justify-between">
                    <p class="text-[11px] text-slate-500 font-mono">
                        <i class="fas fa-calendar-alt mr-1"></i> TA: {{ date('Y') }}/{{ date('Y')+1 }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= INFORMASI TAMBAHAN ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 md:gap-6">
        
        {{-- Informasi Akademik --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-chalkboard text-blue-600 text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800">Informasi Akademik</h3>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2 border-b border-slate-100">
                    <span class="text-xs text-slate-500">IPK Semester Lalu</span>
                    <span class="text-sm font-bold text-slate-800">...</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-100">
                    <span class="text-xs text-slate-500">Total SKS Lulus</span>
                    <span class="text-sm font-bold text-slate-800">...</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-xs text-slate-500">Predikat Kelulusan</span>
                    <span class="text-sm font-bold text-emerald-600">-</span>
                </div>
            </div>
        </div>

        {{-- Pengumuman Terbaru --}}
        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 shadow-sm p-6 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-bullhorn text-indigo-600 text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800">Pengumuman Terbaru</h3>
            </div>
            <div class="space-y-3">
                {{-- <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shrink-0">
                        <i class="fas fa-calendar-alt text-indigo-500 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-800">Jadwal UTS Semester Genap</p>
                        <p class="text-[10px] text-slate-500">Mulai 10 Juni 2026</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shrink-0">
                        <i class="fas fa-file-alt text-indigo-500 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-800">Batas Akhir Pengisian KRS</p>
                        <p class="text-[10px] text-slate-500">20 Juni 2026</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shrink-0">
                        <i class="fas fa-graduation-cap text-indigo-500 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-800">Wisuda Periode II 2026</p>
                        <p class="text-[10px] text-slate-500">Pendaftaran dibuka 1 Juli 2026</p>
                    </div>
                </div> --}}
            </div>
            {{-- <a href="#" class="mt-4 inline-flex items-center gap-1 text-xs text-indigo-600 hover:text-indigo-700 font-medium">
                Lihat semua pengumuman
                <i class="fas fa-arrow-right text-[10px]"></i>
            </a> --}}
        </div>
    </div>

</div>



@endsection