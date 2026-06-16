@extends('layouts.app')

@section('title', 'Kelola Data Dosen')

@section('sidebar-menu')
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
        <i class="fas fa-th-large mr-3 w-5 text-center"></i> Dashboard
    </a>
    <a href="{{ route('admin.dosen.index') }}"
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg shadow-indigo-900/30">
        <i class="fas fa-chalkboard-user mr-3 w-5 text-center"></i> Data Dosen
    </a>
    <a href="{{ route('admin.mahasiswa.index') }}" 
        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
        <i class="fas fa-user-graduate mr-3 w-5 text-center"></i> Data Mahasiswa
    </a>
    <a href="{{ route('admin.matakuliah.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
        <i class="fas fa-book mr-3 w-5 text-center"></i> Mata Kuliah
    </a>
    <a href="{{ route('admin.jadwal.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
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
                                <i class="fas fa-chalkboard-user text-[8px]"></i> Manajemen Dosen
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                                <i class="fas fa-users text-[8px]"></i> {{ $dosens->total() }} Total Dosen
                            </span>
                        </div>
                        
                        <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">
                            Daftar Dosen
                        </h1>
                        
                        <p class="text-xs md:text-sm text-slate-300 font-medium max-w-2xl">
                            Kelola data dosen pengatur kurikulum dan pembimbing akademik (Dosen Wali).
                        </p>
                    </div>
                    
                    <div>
                        <a href="{{ route('admin.dosen.create') }}"
                            class="group inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-900/30 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                            <i class="fas fa-plus text-xs group-hover:rotate-90 transition-transform duration-300"></i>
                            Tambah Dosen
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
                    <a href="{{ route('admin.dosen.export.excel', ['search' => request('search')]) }}" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                        <i class="fas fa-file-excel text-sm"></i> Export Excel
                    </a>
                    
                    <a href="{{ route('admin.dosen.export.pdf', ['search' => request('search')]) }}" target="_blank" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                        <i class="fas fa-file-pdf text-sm"></i> Export PDF
                    </a>
                </div>

                <form action="{{ route('admin.dosen.import.excel') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-2">
                    @csrf
                    <div class="relative">
                        <input type="file" name="file" required 
                            class="text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer transition-all">
                    </div>
                    <button type="submit" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                        <i class="fas fa-upload text-xs"></i> Import Dosen
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= SEARCH BAR ================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
            <form action="{{ route('admin.dosen.index') }}" method="GET" class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fas fa-search text-sm"></i>
                </div>
                <input type="text" name="search" value="{{ $search }}" 
                    placeholder="Cari berdasarkan NIDN atau Nama Dosen..."
                    class="w-full pl-11 pr-24 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all bg-white">
                @if ($search)
                    <a href="{{ route('admin.dosen.index') }}" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 px-3 py-1 text-xs text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all">
                        <i class="fas fa-times mr-1"></i> Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- ================= TABEL DOSEN ================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
            
            <div class="px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                        <i class="fas fa-chalkboard-user text-indigo-600 text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Data Dosen</h2>
                        <p class="text-[10px] text-slate-400">Menampilkan {{ $dosens->firstItem() }} - {{ $dosens->lastItem() }} dari {{ $dosens->total() }} dosen</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-5 py-3 text-center w-16">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">No</span>
                            </th>
                            <th class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">NIDN</span>
                            </th>
                            <th class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Nama Lengkap</span>
                            </th>
                            <th class="px-5 py-3 text-center w-40">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($dosens as $index => $dosen)
                            <tr class="group hover:bg-indigo-50/30 transition-all duration-200">
                                <td class="px-5 py-3 text-center">
                                    <span class="text-xs text-slate-500 font-medium">{{ $dosens->firstItem() + $index }}</span>
                                 </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center">
                                            <i class="fas fa-id-card text-indigo-600 text-xs"></i>
                                        </div>
                                        <span class="font-mono text-sm font-bold text-indigo-700">{{ $dosen->nidn }}</span>
                                    </div>
                                 </td>
                                <td class="px-5 py-3">
                                    <div>
                                        <p class="font-semibold text-slate-800">{{ $dosen->nama }}</p>
                                        <p class="text-[10px] text-slate-400">Dosen {{ $dosen->is_wali ? 'Wali' : 'Pengampu' }}</p>
                                    </div>
                                 </td>
                                <td class="px-5 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.dosen.edit', $dosen->nidn) }}"
                                            class="group/btn inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-500 hover:text-white border border-amber-200 hover:border-amber-500 transition-all duration-200 text-xs font-semibold">
                                            <i class="fas fa-edit text-xs"></i> 
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('admin.dosen.destroy', $dosen->nidn) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data dosen {{ $dosen->nama }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="group/btn inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-500 hover:text-white border border-rose-200 hover:border-rose-500 transition-all duration-200 text-xs font-semibold">
                                                <i class="fas fa-trash text-xs"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                 </td>
                             </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 rounded-2xl bg-slate-50 flex items-center justify-center mb-4">
                                            <i class="fas fa-chalkboard-user text-3xl text-slate-300"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-500">Tidak ada data dosen ditemukan</p>
                                        <p class="text-[11px] text-slate-400 mt-1">Silakan tambah data dosen baru</p>
                                        <a href="{{ route('admin.dosen.create') }}" 
                                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition-all">
                                            <i class="fas fa-plus"></i> Tambah Dosen
                                        </a>
                                    </div>
                                 </td>
                             </tr>
                        @endforelse
                    </tbody>
                 </table>
            </div>

            @if ($dosens->hasPages())
                <div class="px-5 py-3 bg-slate-50 border-t border-slate-100">
                    {{ $dosens->links() }}
                </div>
            @endif
        </div>

        {{-- ================= INFORMASI TAMBAHAN ================= --}}
        @if($dosens->count() > 0)
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-5 border border-indigo-100">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-info-circle text-indigo-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Informasi Data Dosen</p>
                        <p class="text-xs text-slate-500">Total {{ $dosens->total() }} dosen terdaftar dalam sistem akademik</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3 text-xs text-slate-500">
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                        <span>Dosen Wali: {{ $dosens->where('is_wali', true)->count() }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <span>Dosen Pengampu: {{ $dosens->where('is_wali', false)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

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
        
        /* Pagination styling */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .pagination .page-item .page-link {
            padding: 0.5rem 0.75rem;
            border-radius: 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: #64748b;
            background-color: white;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            border-color: transparent;
        }
        
        .pagination .page-item .page-link:hover {
            background-color: #f1f5f9;
            transform: translateY(-1px);
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #818cf8;
        }
    </style>
@endsection