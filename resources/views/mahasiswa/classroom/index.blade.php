@extends('layouts.app')

@section('title', 'Kelas Kuliah Saya')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/mhs.cl.index.css') }}">
@endsection
@section('content')
    <div class="space-y-6 md:space-y-8">

        {{-- ================= HEADER ================= --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl shadow-2xl border border-white/10 transition-all duration-300 hover:shadow-indigo-900/30">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>

            <div class="relative p-6 sm:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-3">
                        {{-- Badges --}}
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-indigo-500/20 text-indigo-300 rounded-full border border-indigo-500/30 backdrop-blur-sm">
                                <i class="fas fa-chalkboard text-[8px]"></i> Ruang Kelas Virtual
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                                <i class="fas fa-calendar-alt text-[8px]"></i> Semester Aktif
                            </span>
                        </div>
                        
                        <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">
                            Kelas Kuliah Saya
                        </h1>
                        <p class="text-xs md:text-sm text-slate-300 font-medium max-w-2xl">
                            Ruang interaksi kelas virtual mahasiswa berdasarkan KRS resmi yang telah disetujui.
                        </p>
                    </div>
                    
                    {{-- Statistik Kelas --}}
                    <div class="flex items-center gap-3 px-4 py-2 bg-white/5 rounded-2xl border border-white/10 backdrop-blur-sm">
                        <div class="text-center">
                            <p class="text-2xl font-black text-white">{{ $kelasSaya->count() }}</p>
                            <p class="text-[9px] text-slate-400 uppercase tracking-wider">Total Kelas</p>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= GRID KELAS ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-7">
            @forelse($kelasSaya as $index => $row)
                <div class="group relative animate-fade-in-up" style="animation-delay: {{ $index * 0.05 }}s">
                    {{-- Card --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
                        
                        {{-- Header Card dengan Warna Berbeda per Kelas --}}
                        @php
                            $gradients = [
                                'from-indigo-600 via-indigo-700 to-violet-700',
                                'from-emerald-600 via-emerald-700 to-teal-700',
                                'from-rose-600 via-rose-700 to-pink-700',
                                'from-amber-600 via-amber-700 to-orange-700',
                                'from-cyan-600 via-cyan-700 to-blue-700',
                                'from-purple-600 via-purple-700 to-fuchsia-700',
                            ];
                            $gradient = $gradients[$index % count($gradients)];
                        @endphp
                        
                        <div class="h-28 bg-gradient-to-br {{ $gradient }} p-4 flex flex-col justify-between relative overflow-hidden">
                            <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                            <div class="absolute -left-4 -bottom-4 w-20 h-20 bg-white/5 rounded-full blur-xl"></div>
                            
                            <div class="relative flex items-center justify-between">
                                <span class="text-[10px] font-mono text-white/80 uppercase tracking-wider flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-[8px]"></i>
                                    TA. {{ date('Y') }}/{{ date('Y')+1 }}
                                </span>
                                <div class="flex items-center gap-1">
                                    <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                                        <i class="fas fa-chalkboard-user text-white/70 text-xs"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="relative flex items-center justify-between">
                                <span class="px-2.5 py-1 bg-white/20 text-white text-[10px] font-bold rounded-lg border border-white/20 backdrop-blur-sm">
                                    <i class="fas fa-users mr-1 text-[8px]"></i>
                                    Kelas {{ $row->kelas }}
                                </span>
                                @php
                                    $sks = $row->matakuliah->sks ?? 0;
                                @endphp
                                <span class="px-2 py-0.5 bg-white/15 text-white text-[9px] font-bold rounded-md border border-white/20">
                                    {{ $sks }} SKS
                                </span>
                            </div>
                        </div>
                        
                        {{-- Body Card --}}
                        <div class="p-5 flex-1">
                            <h3 class="font-extrabold text-slate-800 text-base leading-snug line-clamp-2 min-h-[3rem] group-hover:text-indigo-600 transition-colors">
                                {{ $row->matakuliah->nama_matakuliah }}
                            </h3>
                            
                            <div class="mt-4 space-y-3">
                                {{-- Kode MK --}}
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="w-6 h-6 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                                        <i class="fas fa-barcode text-slate-400 text-[10px]"></i>
                                    </div>
                                    <span class="font-mono text-slate-500 text-[10px]">{{ $row->matakuliah->kode_matakuliah ?? 'MK-' . $row->id }}</span>
                                </div>
                                
                                {{-- Info Dosen --}}
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="w-6 h-6 rounded-lg bg-indigo-50 flex items-center justify-center shrink-0">
                                        <i class="fas fa-user-tie text-indigo-500 text-[10px]"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-700">{{ $row->dosen->nama ?? 'Dosen belum ditentukan' }}</p>
                                        <p class="text-[10px] text-slate-400">Dosen Pengampu</p>
                                    </div>
                                </div>

                                {{-- Info Jadwal Hari & Jam --}}
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="w-6 h-6 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0">
                                        <i class="far fa-clock text-emerald-500 text-[10px]"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-700">
                                            {{ $row->hari ?? 'Hari belum ditentukan' }}
                                        </p>
                                        @if(isset($row->jam_mulai) && isset($row->jam_selesai))
                                            <p class="text-[10px] text-slate-400">
                                                {{ date('H:i', strtotime($row->jam_mulai)) }} - {{ date('H:i', strtotime($row->jam_selesai)) }} WIB
                                            </p>
                                        @endif
                                    </div>
                                </div>

                              
                            </div>
                        </div>
                        
                        {{-- Footer Card --}}
                        <div class="p-4 border-t border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                            <a href="{{ route('mahasiswa.classroom.show', $row->id) }}"
                                class="group/link w-full text-center block text-sm bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold py-2.5 rounded-xl shadow-md shadow-indigo-900/20 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-door-open mr-2 text-xs group-hover/link:scale-110 transition-transform"></i> 
                                Masuk Kelas
                                <i class="fas fa-arrow-right ml-2 text-xs group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                    
                    {{-- Decorative corner --}}
                    <div class="absolute top-3 right-3 w-2 h-2 rounded-full bg-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-slate-200 shadow-sm">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>
                            </div>
                            <div class="relative">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center mx-auto mb-5">
                                    <i class="fas fa-chalkboard-user text-3xl text-slate-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-slate-700 mb-2">Belum Ada Kelas Aktif</h3>
                                <p class="text-sm text-slate-500 max-w-md mx-auto">
                                    Pastikan Anda sudah mengisi KRS dan disetujui oleh Dosen Wali untuk memunculkan ruang kelas.
                                </p>
                                <a href="{{ route('mahasiswa.krs.index') }}"
                                    class="inline-flex items-center gap-2 mt-6 px-5 py-2.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold text-sm rounded-xl transition-all duration-200 hover:-translate-y-0.5">
                                    <i class="fas fa-file-alt"></i> 
                                    Buka Pengisian KRS
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- ================= INFORMASI TAMBAHAN ================= --}}
        @if($kelasSaya->count() > 0)
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-5 border border-indigo-100">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-info-circle text-indigo-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Informasi Kelas</p>
                        <p class="text-xs text-slate-500">Akses materi, tugas, dan diskusi melalui ruang kelas virtual.</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 text-xs">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <span class="text-slate-600">Kelas Aktif</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                        <span class="text-slate-600">Tugas Tersedia</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                        <span class="text-slate-600">Materi Terbaru</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>


@endsection