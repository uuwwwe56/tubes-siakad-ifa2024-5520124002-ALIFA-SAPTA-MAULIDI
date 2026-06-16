@extends('layouts.app')

@section('title', 'Pengisian KRS')

@section('content')
    <div class="space-y-6 md:space-y-8">

        {{-- ================= HEADER / INFO MAHASISWA ================= --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl shadow-2xl border border-white/10 transition-all duration-300 hover:shadow-indigo-900/30">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>

            <div class="relative p-6 sm:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                    <div class="space-y-3 text-center md:text-left w-full md:w-auto">
                        {{-- Badges --}}
                        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-indigo-500/20 text-indigo-300 rounded-full border border-indigo-500/30 backdrop-blur-sm">
                                <i class="fas fa-file-alt text-[8px]"></i> Kartu Rencana Studi
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                                <i class="fas fa-calendar-alt text-[8px]"></i> Semester {{ $mahasiswa->semester_aktif ?? 'Ganjil' }}
                            </span>
                        </div>
                        
                        <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">{{ $mahasiswa->nama }}</h1>
                        
                        <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                            <p class="text-xs md:text-sm text-slate-300 font-medium flex items-center gap-2">
                                <i class="fas fa-id-card text-indigo-400 text-xs"></i>
                                <span class="font-mono bg-slate-800/50 px-2 py-1 rounded-lg text-indigo-300 font-bold border border-slate-700/50">{{ $mahasiswa->npm }}</span>
                            </p>
                            <p class="text-xs md:text-sm text-slate-300 font-medium flex items-center gap-2">
                                <i class="fas fa-users text-indigo-400 text-xs"></i>
                                Kelas <span class="text-white font-semibold">{{ $mahasiswa->kelas }}</span>
                            </p>
                            <p class="text-xs md:text-sm text-slate-300 font-medium flex items-center gap-2">
                                <i class="fas fa-calendar text-indigo-400 text-xs"></i>
                                Angkatan <span class="text-white font-semibold">{{ $mahasiswa->angkatan }}</span>
                            </p>
                        </div>
                        
                        <div class="inline-flex items-center gap-2 text-xs bg-white/5 px-3 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                            <div class="w-6 h-6 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                <i class="fas fa-user-tie text-indigo-400 text-[10px]"></i>
                            </div>
                            <span class="font-medium text-slate-400">Dosen Wali:</span>
                            <span class="font-semibold text-white">{{ $mahasiswa->dosenWali->nama ?? $mahasiswa->dosen->nama ?? 'Belum Ditentukan' }}</span>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    <div class="shrink-0">
                        @if ($status_krs == 'Disetujui' || $status_krs == 'disetujui')
                            <div class="group relative">
                                <div class="absolute inset-0 rounded-xl bg-emerald-500 blur-lg opacity-30 group-hover:opacity-50 transition-opacity"></div>
                                <span class="relative px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600/20 to-emerald-500/20 text-emerald-400 text-sm font-bold border border-emerald-500/30 inline-flex items-center gap-2 shadow-lg backdrop-blur-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <i class="fas fa-check-circle"></i> Status: Disetujui
                                </span>
                            </div>
                        @elseif($status_krs == 'Menunggu Persetujuan' || $status_krs == 'pending')
                            <div class="group relative">
                                <div class="absolute inset-0 rounded-xl bg-amber-500 blur-lg opacity-30 group-hover:opacity-50 transition-opacity"></div>
                                <span class="relative px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-600/20 to-amber-500/20 text-amber-400 text-sm font-bold border border-amber-500/30 inline-flex items-center gap-2 shadow-lg backdrop-blur-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                    <i class="fas fa-clock"></i> Status: Menunggu Persetujuan
                                </span>
                            </div>
                        @elseif($status_krs == 'Ditolak')
                            <div class="group relative">
                                <div class="absolute inset-0 rounded-xl bg-rose-500 blur-lg opacity-30 group-hover:opacity-50 transition-opacity"></div>
                                <span class="relative px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-600/20 to-rose-500/20 text-rose-400 text-sm font-bold border border-rose-500/30 inline-flex items-center gap-2 shadow-lg backdrop-blur-sm">
                                    <i class="fas fa-times-circle"></i> Status: Ditolak
                                </span>
                            </div>
                        @else
                            <div class="group relative">
                                <div class="absolute inset-0 rounded-xl bg-slate-500 blur-lg opacity-30 group-hover:opacity-50 transition-opacity"></div>
                                <span class="relative px-4 py-2.5 rounded-xl bg-white/10 text-slate-300 text-sm font-bold border border-white/10 inline-flex items-center gap-2 shadow-lg backdrop-blur-sm">
                                    <i class="fas fa-edit"></i> Status: Draft
                                </span>
                            </div>
                        @endif
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

        @if (session('error'))
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl text-sm font-medium text-rose-800 flex items-center gap-3 animate-slide-in">
                <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-rose-600"></i>
                </div>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if ($status_krs == 'Ditolak')
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl text-sm font-medium text-rose-800 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center">
                    <i class="fas fa-info-circle text-rose-600"></i>
                </div>
                <p>Pengajuan KRS Anda ditolak oleh Dosen Wali. Silakan hubungi dosen wali untuk informasi lebih lanjut.</p>
            </div>
        @endif

        {{-- ================= TABEL MATA KULIAH ================= --}}
        <form action="{{ route('mahasiswa.krs.store') }}" method="POST" id="formSubmitKrs">
            @csrf
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <i class="fas fa-book-open text-indigo-600 text-sm"></i>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Daftar Mata Kuliah Semester {{ $mahasiswa->semester_aktif }}
                        </h2>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1.5 bg-indigo-50 rounded-xl">
                        <i class="fas fa-chalkboard text-indigo-500 text-xs"></i>
                        <span class="text-[11px] font-bold text-indigo-700 uppercase tracking-wider">
                            Total: <span class="text-indigo-600">{{ $matakuliahs->sum('sks') }} SKS</span> tersedia
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-4 sm:px-6 py-3 text-center w-16">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Pilih</span>
                                </th>
                                <th class="px-4 sm:px-6 py-3">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Mata Kuliah</span>
                                </th>
                                <th class="px-4 sm:px-6 py-3 text-center w-20">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">SKS</span>
                                </th>
                                <th class="px-4 sm:px-6 py-3">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider hidden md:inline">Dosen Pengampu</span>
                                </th>
                                <th class="px-4 sm:px-6 py-3 text-center">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider hidden lg:inline">Hari / Jam</span>
                                </th>
                                <th class="px-4 sm:px-6 py-3 text-center w-24">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Kelas</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($matakuliahs as $mk)
                                @php
                                    $is_checked = $krsData->contains('kode_matakuliah', $mk->kode_matakuliah);
                                    $jadwal = $mk->jadwals->first();
                                    $is_locked = ($status_krs != 'Draft' && $status_krs != 'draft');
                                @endphp

                                <tr class="group hover:bg-indigo-50/40 transition-all duration-200 {{ $is_checked ? 'bg-indigo-50/30 border-l-2 border-l-indigo-500' : '' }}">
                                    <td class="px-4 sm:px-6 py-3 text-center">
                                        <div class="relative">
                                            <input type="checkbox" name="matakuliah[]" value="{{ $mk->kode_matakuliah }}"
                                                {{ $is_checked ? 'checked' : '' }}
                                                {{ $is_locked ? 'disabled' : '' }}
                                                class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-2 focus:ring-indigo-500 disabled:opacity-50 cursor-pointer disabled:cursor-not-allowed transition-all">
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3">
                                        <div class="font-semibold text-slate-800 text-sm">{{ $mk->nama_matakuliah }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono mt-0.5">{{ $mk->kode_matakuliah }}</div>
                                     </td>
                                    <td class="px-4 sm:px-6 py-3 text-center">
                                        <span class="inline-flex items-center justify-center px-2 py-1 rounded-md bg-slate-100 text-slate-700 font-bold text-xs min-w-[50px]">
                                            {{ $mk->sks }} SKS
                                        </span>
                                     </td>
                                    <td class="px-4 sm:px-6 py-3 text-slate-600">
                                        <div class="hidden md:flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-indigo-50 flex items-center justify-center">
                                                <i class="fas fa-user text-indigo-500 text-[10px]"></i>
                                            </div>
                                            @if ($jadwal?->dosen?->nama)
                                                <span class="text-xs font-medium">{{ $jadwal->dosen->nama }}</span>
                                            @else
                                                <span class="text-xs text-slate-400 italic">Dosen belum ditentukan</span>
                                            @endif
                                        </div>
                                        <div class="md:hidden">
                                            @if ($jadwal?->dosen?->nama)
                                                <span class="text-xs font-medium">{{ $jadwal->dosen->nama }}</span>
                                            @else
                                                <span class="text-xs text-slate-400 italic">-</span>
                                            @endif
                                        </div>
                                     </td>
                                    <td class="px-4 sm:px-6 py-3 text-center">
                                        <div class="hidden lg:flex items-center justify-center">
                                            @if ($jadwal)
                                                <div class="inline-flex items-center gap-1.5 px-2 py-1 rounded-lg bg-slate-50 text-xs">
                                                    <i class="fas fa-calendar-day text-indigo-400 text-[10px]"></i>
                                                    <span class="font-medium">{{ $jadwal->hari }}</span>
                                                    <span class="text-slate-400">•</span>
                                                    <i class="fas fa-clock text-indigo-400 text-[10px]"></i>
                                                    <span class="font-mono text-[10px]">{{ date('H:i', strtotime($jadwal->jam_mulai)) }}-{{ date('H:i', strtotime($jadwal->jam_selesai)) }}</span>
                                                </div>
                                            @else
                                                <span class="text-xs text-slate-400">-</span>
                                            @endif
                                        </div>
                                        <div class="lg:hidden">
                                            @if ($jadwal)
                                                <span class="text-xs">{{ $jadwal->hari }}</span>
                                            @else
                                                <span class="text-xs text-slate-400">-</span>
                                            @endif
                                        </div>
                                     </td>
                                    <td class="px-4 sm:px-6 py-3 text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-gradient-to-r from-violet-50 to-purple-50 text-violet-700 text-xs font-bold border border-violet-100">
                                            <i class="fas fa-users mr-1 text-[9px]"></i>
                                            Kelas {{ $mahasiswa->kelas }}
                                        </span>
                                     </td>
                                 </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                                                <i class="fas fa-book-open text-3xl text-slate-300"></i>
                                            </div>
                                            <p class="font-medium text-slate-500">Tidak ada mata kuliah wajib yang tersedia</p>
                                            <p class="text-xs text-slate-400 mt-1">di Semester {{ $mahasiswa->semester_aktif }} Anda.</p>
                                        </div>
                                    </td>
                                 </tr>
                            @endforelse
                        </tbody>
                     </table>
                </div>
            </div>
        </form>

        {{-- ================= ACTION BAR ================= --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-5 border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center gap-2 order-2 sm:order-1">
                <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center">
                    <i class="fas fa-info-circle text-indigo-500 text-xs"></i>
                </div>
                <p class="text-xs text-slate-400 font-medium">
                    Pastikan mata kuliah yang dipilih sesuai dengan rencana studi Anda sebelum submit.
                </p>
            </div>

            <div class="flex items-center gap-3 flex-wrap justify-center order-1 sm:order-2 w-full sm:w-auto">
                @if ($status_krs == 'Draft' || $status_krs == 'draft')
                    <button type="submit" form="formSubmitKrs"
                        class="group px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-semibold text-sm rounded-xl shadow-lg shadow-indigo-900/30 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 inline-flex items-center gap-2">
                        <i class="fas fa-paper-plane text-sm group-hover:translate-x-1 transition-transform"></i>
                        Submit KRS ke Dosen Wali
                    </button>
                @elseif($status_krs == 'Menunggu Persetujuan' || $status_krs == 'pending')
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex items-center gap-2 px-3 py-2 bg-amber-50 rounded-xl">
                            <i class="fas fa-info-circle text-amber-500 text-xs"></i>
                            <p class="text-xs font-medium text-amber-700">Ingin mengubah pilihan matakuliah?</p>
                        </div>
                        <form action="{{ route('mahasiswa.krs.cancel') }}" method="POST" class="inline m-0 p-0">
                            @csrf
                            <button type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin membatalkan pengajuan KRS untuk diperbaiki?')"
                                class="group px-5 py-2.5 bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 font-semibold text-sm rounded-xl transition-all duration-200 hover:-translate-y-0.5 inline-flex items-center gap-2">
                                <i class="fas fa-undo-alt text-sm group-hover:rotate-12 transition-transform"></i>
                                Cancel / Perbaiki KRS
                            </button>
                        </form>
                    </div>
                @elseif($status_krs == 'Disetujui' || $status_krs == 'disetujui')
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-50 text-emerald-700 font-medium text-sm rounded-xl border border-emerald-200">
                            <i class="fas fa-lock"></i> Pilihan KRS terkunci (sudah disetujui)
                        </span>
                        <a href="{{ route('mahasiswa.krs.print') }}" target="_blank"
                            class="group px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white font-semibold text-sm rounded-xl shadow-lg shadow-emerald-900/30 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 inline-flex items-center gap-2">
                            <i class="fas fa-print text-sm group-hover:scale-110 transition-transform"></i>
                            Cetak Lembar FRS / KRS
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse-slow {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.05);
            }
        }
        
        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }
        
        .animate-slide-in {
            animation: slide-in 0.3s ease-out forwards;
        }
        
        /* Custom checkbox styling */
        input[type="checkbox"]:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }
        
        input[type="checkbox"]:focus {
            ring-color: #6366f1;
        }
        
        /* Table row hover effect */
        tbody tr {
            transition: all 0.2s ease;
        }
        
        /* Responsive table */
        @media (max-width: 768px) {
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
@endsection