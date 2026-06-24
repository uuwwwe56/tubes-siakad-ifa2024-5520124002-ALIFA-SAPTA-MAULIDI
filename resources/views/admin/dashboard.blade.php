@extends('layouts.app')


@section('title', 'Dashboard Admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dahAdmin.css') }}">
@endsection


@section('content')

<div class="space-y-6 md:space-y-8">

    {{-- ================= HEADER WELCOME ================= --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl border border-white/20 transition-all duration-300 hover:shadow-indigo-500/30">
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-white/5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>

        <div class="relative p-6 sm:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                <div class="space-y-3">
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-white/20 text-white rounded-full border border-white/30 backdrop-blur-sm">
                            <i class="fas fa-shield-alt text-[8px]"></i> Administrator
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/30 text-emerald-200 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                            <i class="fas fa-check-circle text-[8px]"></i> Super Access
                        </span>
                    </div>
                    
                    <h1 class="text-2xl md:text-4xl font-black text-white tracking-tight">
                        Selamat Datang, {{ Auth::user()->username }}! 👋
                    </h1>
                    
                    <p class="text-sm text-indigo-100 max-w-2xl">
                        Kelola seluruh aktivitas akademik kampus melalui dashboard administrator. 
                        Pantau data dosen, mahasiswa, mata kuliah, dan jadwal kuliah dalam satu platform terintegrasi.
                    </p>
                </div>
                
                <div class="flex items-center gap-2 px-4 py-2 bg-white/10 rounded-2xl border border-white/20 backdrop-blur-sm">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-white text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs text-white/80">Hari Ini</p>
                        <p class="text-sm font-bold text-white">{{ date('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= STATISTIK GRID ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
        
        {{-- Total Dosen --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-chalkboard-user text-[9px]"></i> Total Dosen
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-indigo-600 tracking-tight pt-1">
                            {{ \App\Models\Dosen::count() }}
                        </h2>
                        <p class="text-[10px] text-slate-400">Tenaga Pendidik</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chalkboard-user text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-indigo-500 to-indigo-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

        {{-- Total Mahasiswa --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-user-graduate text-[9px]"></i> Mahasiswa
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-emerald-600 tracking-tight pt-1">
                            {{ \App\Models\Mahasiswa::count() }}
                        </h2>
                        <p class="text-[10px] text-slate-400">Mahasiswa Aktif</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-user-graduate text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-emerald-500 to-emerald-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

        {{-- Total Mata Kuliah --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-book text-[9px]"></i> Mata Kuliah
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-amber-600 tracking-tight pt-1">
                            {{ \App\Models\Matakuliah::count() }}
                        </h2>
                        <p class="text-[10px] text-slate-400">Total Matakuliah</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book-open text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-amber-500 to-amber-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

        {{-- Total Jadwal Aktif --}}
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-slate-400 text-[10px] font-bold tracking-wider uppercase flex items-center gap-1">
                            <i class="fas fa-calendar-alt text-[9px]"></i> Jadwal Aktif
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-rose-600 tracking-tight pt-1">
                            {{ \App\Models\Jadwal::count() }}
                        </h2>
                        <p class="text-[10px] text-slate-400">Perkuliahan Aktif</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-rose-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-rose-500 to-rose-600 w-0 group-hover:w-full transition-all duration-300"></div>
        </div>

    </div>

    {{-- ================= PINTASAN CEPAT & INFORMASI ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Pintasan Cepat --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                        <i class="fas fa-bolt text-indigo-600 text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Pintasan Cepat</h2>
                        <p class="text-[10px] text-slate-400">Akses cepat ke menu utama administrator</p>
                    </div>
                </div>
            </div>
            
            <div class="p-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <a href="{{ route('admin.dosen.index') }}"
                        class="group p-4 border border-slate-200 rounded-xl hover:border-indigo-500 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-transparent transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center group-hover:bg-indigo-500 transition-colors duration-200">
                                <i class="fas fa-chalkboard-user text-indigo-600 group-hover:text-white transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                    👨‍🏫 Kelola Data Dosen
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Tambah, edit dan hapus data dosen
                                </p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.mahasiswa.index') }}"
                        class="group p-4 border border-slate-200 rounded-xl hover:border-emerald-500 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-transparent transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-500 transition-colors duration-200">
                                <i class="fas fa-user-graduate text-emerald-600 group-hover:text-white transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                    🎓 Kelola Data Mahasiswa
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Kelola data mahasiswa dan informasi akademik
                                </p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.matakuliah.index') }}"
                        class="group p-4 border border-slate-200 rounded-xl hover:border-amber-500 hover:bg-gradient-to-r hover:from-amber-50 hover:to-transparent transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center group-hover:bg-amber-500 transition-colors duration-200">
                                <i class="fas fa-book text-amber-600 group-hover:text-white transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-800 group-hover:text-amber-600 transition-colors">
                                    📚 Kelola Mata Kuliah
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Tambah, edit dan hapus data mata kuliah
                                </p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.jadwal.index') }}"
                        class="group p-4 border border-slate-200 rounded-xl hover:border-rose-500 hover:bg-gradient-to-r hover:from-rose-50 hover:to-transparent transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center group-hover:bg-rose-500 transition-colors duration-200">
                                <i class="fas fa-calendar-alt text-rose-600 group-hover:text-white transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-800 group-hover:text-rose-600 transition-colors">
                                    📅 Kelola Jadwal Kuliah
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Atur jadwal perkuliahan dan ruangan
                                </p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>

        
        {{-- ================= AKTIVITAS TERBARU (OPTIONAL) ================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                        <i class="fas fa-history text-slate-500 text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Aktivitas Terbaru</h2>
                        <p class="text-[10px] text-slate-400">Log aktivitas sistem dalam 7 hari terakhir</p>
                    </div>
                </div>
            </div>
            
            <div class="p-5">
                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-user-plus text-indigo-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-slate-700">Penambahan data mahasiswa baru</p>
                            <p class="text-[10px] text-slate-400">2 jam yang lalu</p>
                        </div>
                        <span class="text-[9px] text-slate-400">Pending</span>
                    </div>
                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-slate-700">Persetujuan KRS mahasiswa</p>
                            <p class="text-[10px] text-slate-400">5 jam yang lalu</p>
                        </div>
                        <span class="text-[9px] text-emerald-600 font-medium">Selesai</span>
                    </div>
                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                            <i class="fas fa-edit text-amber-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-slate-700">Update jadwal kuliah</p>
                            <p class="text-[10px] text-slate-400">1 hari yang lalu</p>
                        </div>
                        <span class="text-[9px] text-amber-600 font-medium">Proses</span>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 text-center">
                    <a href="#" class="text-[10px] text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-1">
                        Lihat semua aktivitas
                        <i class="fas fa-arrow-right text-[8px]"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>


</div>



@endsection