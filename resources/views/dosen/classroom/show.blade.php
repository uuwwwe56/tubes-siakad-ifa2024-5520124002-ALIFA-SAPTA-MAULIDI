@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dosen.cl.show.css') }}">
    <script src="{{ asset('js/dosen.cl.show.js') }}"></script>
@endsection
@section('content')
    <div class="space-y-6 md:space-y-8">

        {{-- ================= HEADER KELAS ================= --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl shadow-2xl border border-white/10 transition-all duration-300 hover:shadow-indigo-900/30">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>

            <div class="relative p-6 sm:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                    <div class="space-y-3">
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-indigo-500/20 text-indigo-300 rounded-full border border-indigo-500/30 backdrop-blur-sm">
                                <i class="fas fa-chalkboard-user text-[8px]"></i> Manajemen Kelas
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                                <i class="fas fa-users text-[8px]"></i> Kelas {{ $kelas->kelas }}
                            </span>
                        </div>
                        
                        <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">
                            {{ $kelas->matakuliah->nama_matakuliah }}
                        </h1>
                        
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/5 rounded-xl border border-white/10 backdrop-blur-sm">
                                <i class="fas fa-calendar-alt text-indigo-400 text-xs"></i>
                                <span class="text-sm text-slate-300">{{ $kelas->hari ?? 'Hari belum ditentukan' }}</span>
                            </div>
                            @if(isset($kelas->jam_mulai) && isset($kelas->jam_selesai))
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/5 rounded-xl border border-white/10 backdrop-blur-sm">
                                <i class="fas fa-clock text-indigo-400 text-xs"></i>
                                <span class="text-sm text-slate-300">{{ date('H:i', strtotime($kelas->jam_mulai)) }} - {{ date('H:i', strtotime($kelas->jam_selesai)) }} WIB</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <button onclick="openModal('modalPertemuan')"
                        class="group px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-900/30 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 inline-flex items-center gap-2">
                        <i class="fas fa-plus text-xs group-hover:rotate-90 transition-transform duration-300"></i> 
                        Buat Pertemuan Baru
                    </button>
                </div>
            </div>
        </div>

        {{-- ================= DAFTAR PERTEMUAN ================= --}}
        <div class="space-y-6 md:space-y-8">
            @forelse($pertemuans as $index => $ptm)
                <div class="group animate-fade-in-up" style="animation-delay: {{ $index * 0.05 }}s">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                        
                        {{-- Header Pertemuan --}}
                        <div class="px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-md">
                                    <span class="text-white font-bold text-sm">{{ sprintf('%02d', $ptm->pertemuan_ke) }}</span>
                                </div>
                                <div>
                                    <div class="flex flex-wrap gap-2 mb-1">
                                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-600">
                                            Pertemuan {{ $ptm->pertemuan_ke }}
                                        </span>
                                        <span class="text-[10px] font-medium px-2 py-0.5 rounded-md {{ $ptm->is_absensi_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                            <i class="fas {{ $ptm->is_absensi_active ? 'fa-check-circle' : 'fa-lock' }} mr-1 text-[8px]"></i>
                                            {{ $ptm->is_absensi_active ? 'Absensi Aktif' : 'Absensi Tutup' }}
                                        </span>
                                    </div>
                                    <h2 class="text-base font-bold text-slate-800">{{ $ptm->judul_topik }}</h2>
                                    @if($ptm->deskripsi)
                                        <p class="text-xs text-slate-500 mt-1">{{ $ptm->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2">
                                <button onclick="openMateriModal('{{ $ptm->id }}')"
                                    class="group/btn px-3 py-1.5 bg-sky-50 hover:bg-sky-500 text-sky-700 hover:text-white rounded-lg border border-sky-200 hover:border-sky-500 transition-all duration-200 text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-file-upload text-xs"></i> Materi
                                </button>
                                <button onclick="openTugasModal('{{ $ptm->id }}')"
                                    class="group/btn px-3 py-1.5 bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white rounded-lg border border-amber-200 hover:border-amber-500 transition-all duration-200 text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-tasks text-xs"></i> Tugas
                                </button>
                                
                                <form action="{{ route('dosen.classroom.pertemuan.toggleAbsensi', $ptm->id) }}" method="POST" class="inline">
                                    @csrf
                                    @if ($ptm->is_absensi_active)
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-all duration-200 text-xs font-semibold inline-flex items-center gap-1 shadow-sm">
                                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> 
                                            Absensi Aktif (Tutup)
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-slate-100 hover:bg-emerald-500 text-slate-700 hover:text-white rounded-lg border border-slate-300 hover:border-emerald-500 transition-all duration-200 text-xs font-semibold inline-flex items-center gap-1">
                                            <i class="fas fa-power-off text-xs"></i> Aktifkan Absensi
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>

                        {{-- Body Pertemuan --}}
                        <div class="p-5 md:p-6 space-y-5">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                
                                {{-- Materi Section --}}
                                <div class="bg-gradient-to-br from-sky-50 to-white rounded-xl p-4 border border-sky-100 shadow-sm">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-7 h-7 rounded-lg bg-sky-100 flex items-center justify-center">
                                            <i class="fas fa-book-open text-sky-600 text-sm"></i>
                                        </div>
                                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wide">Materi File Kuliah</h4>
                                        <span class="ml-auto text-[10px] font-bold text-sky-600 bg-sky-100 px-2 py-0.5 rounded-full">{{ $ptm->materis->count() }} File</span>
                                    </div>
                                    <div class="space-y-2">
                                        @forelse($ptm->materis as $mat)
                                            <div class="flex justify-between items-center gap-2 bg-white p-2.5 rounded-xl border border-slate-200 hover:border-sky-200 transition-all">
                                                <div class="flex items-center gap-2 flex-1 min-w-0">
                                                    <i class="fas fa-file-pdf text-red-500 text-sm"></i>
                                                    <span class="font-medium text-slate-700 text-sm truncate">{{ $mat->judul_materi }}</span>
                                                </div>
                                                <a href="{{ asset('storage/' . $mat->file_path) }}" target="_blank"
                                                    class="shrink-0 px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold text-xs rounded-lg transition-all hover:-translate-y-0.5 inline-flex items-center gap-1">
                                                    <i class="fas fa-download text-[10px]"></i> Download
                                                </a>
                                            </div>
                                        @empty
                                            <div class="text-center py-4">
                                                <i class="fas fa-folder-open text-slate-300 text-2xl mb-1 block"></i>
                                                <p class="text-xs text-slate-400 italic">Belum ada materi terunggah.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                {{-- Tugas Section --}}
                                <div class="bg-gradient-to-br from-amber-50 to-white rounded-xl p-4 border border-amber-100 shadow-sm">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center">
                                            <i class="fas fa-clipboard-list text-amber-600 text-sm"></i>
                                        </div>
                                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wide">Instruksi Tugas</h4>
                                        <span class="ml-auto text-[10px] font-bold text-amber-600 bg-amber-100 px-2 py-0.5 rounded-full">{{ $ptm->tugases->count() }} Tugas</span>
                                    </div>
                                    <div class="space-y-2">
                                        @forelse($ptm->tugases as $tgs)
                                            <div class="bg-white p-3 rounded-xl border border-amber-200 hover:shadow-sm transition-all">
                                                <p class="font-bold text-slate-800 text-sm">{{ $tgs->judul_tugas }}</p>
                                                <p class="text-slate-600 text-xs mt-1">{{ $tgs->instruksi }}</p>
                                                <p class="text-rose-600 font-semibold mt-2 text-[11px] inline-flex items-center gap-1">
                                                    <i class="fas fa-hourglass-end"></i> Deadline: {{ date('d M Y, H:i', strtotime($tgs->deadline)) }} WIB
                                                </p>
                                            </div>
                                        @empty
                                            <div class="text-center py-4">
                                                <i class="fas fa-tasks text-slate-300 text-2xl mb-1 block"></i>
                                                <p class="text-xs text-slate-400 italic">Tidak ada penugasan di pertemuan ini.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            {{-- Monitoring Absensi --}}
                            <div class="bg-gradient-to-br from-emerald-50/40 to-emerald-50/20 rounded-xl border border-emerald-100 overflow-hidden">
                                <div class="bg-emerald-100/60 px-4 py-2.5 border-b border-emerald-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                                    <span class="font-bold text-slate-800 text-xs inline-flex items-center gap-1.5">
                                        <i class="fas fa-user-check text-emerald-600"></i> Rekap Presensi Mahasiswa
                                    </span>
                                    <div class="flex items-center gap-3">
                                        <span class="text-[11px] font-medium text-slate-500">
                                            Sesi: {!! $ptm->is_absensi_active
                                                ? '<span class="text-emerald-600 font-bold">Terbuka</span>'
                                                : '<span class="text-slate-400 font-bold">Tertutup</span>' !!}
                                        </span>
                                        <span class="px-2 py-0.5 bg-emerald-600 text-white font-bold rounded-md text-[10px]">
                                            {{ $ptm->absensis->count() }} Hadir
                                        </span>
                                    </div>
                                </div>
                                <div class="p-3 max-h-52 overflow-y-auto">
                                    @if ($ptm->absensis->isNotEmpty())
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2">
                                            @foreach ($ptm->absensis as $abs)
                                                @php
                                                    $statusConfig = [
                                                        'hadir' => 'bg-emerald-100 text-emerald-800',
                                                        'izin' => 'bg-amber-100 text-amber-800',
                                                        'sakit' => 'bg-sky-100 text-sky-800',
                                                        'alfa' => 'bg-rose-100 text-rose-800',
                                                    ];
                                                    $statusClass = $statusConfig[$abs->status] ?? 'bg-slate-100 text-slate-800';
                                                @endphp
                                                <div class="bg-white p-2 rounded-lg border border-slate-200 shadow-sm">
                                                    <p class="font-semibold text-slate-800 text-xs truncate">{{ $abs->mahasiswa->nama }}</p>
                                                    <p class="text-slate-400 font-mono text-[9px]">{{ $abs->npm }}</p>
                                                    <span class="mt-1 inline-block px-1.5 py-0.5 font-bold uppercase rounded text-[9px] {{ $statusClass }}">
                                                        {{ $abs->status }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-xs text-slate-400 italic text-center py-3">Belum ada mahasiswa yang mengisi daftar hadir.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Nilai Tugas Mahasiswa --}}
                            @if ($ptm->tugases->isNotEmpty())
                                <div class="border border-slate-100 rounded-xl overflow-hidden">
                                    <div class="bg-slate-100/80 px-4 py-2.5 border-b border-slate-200">
                                        <h4 class="text-xs font-bold text-slate-700 inline-flex items-center gap-1.5">
                                            <i class="fas fa-star text-yellow-500"></i> Nilai & Hasil Submit Tugas Mahasiswa
                                        </h4>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left text-xs">
                                            <thead>
                                                <tr class="bg-slate-50 border-b border-slate-200 text-slate-600">
                                                    <th class="p-2.5 font-semibold">Mahasiswa</th>
                                                    <th class="p-2.5 font-semibold">File Jawaban</th>
                                                    <th class="p-2.5 font-semibold text-center">Nilai</th>
                                                    <th class="p-2.5 font-semibold text-right">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ptm->tugases as $tgs)
                                                    @forelse($tgs->submissions as $sub)
                                                        <tr class="border-b last:border-none hover:bg-slate-50/60">
                                                            <td class="p-2.5">
                                                                <p class="font-medium text-slate-800 text-sm">{{ $sub->mahasiswa->nama }}</p>
                                                                <p class="text-slate-400 text-[10px] font-mono">{{ $sub->npm }}</p>
                                                             </td>
                                                            <td class="p-2.5">
                                                                <a href="{{ asset('storage/' . $sub->file_jawaban) }}"
                                                                    class="text-indigo-600 font-medium hover:underline inline-flex items-center gap-1 text-xs" target="_blank">
                                                                    <i class="fas fa-file-download"></i> Lihat
                                                                </a>
                                                             </td>
                                                            <td class="p-2.5 text-center">
                                                                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 font-bold border border-indigo-200 rounded-lg text-xs">
                                                                    {{ $sub->nilai ?? '—' }}
                                                                </span>
                                                             </td>
                                                            <td class="p-2.5 text-right">
                                                                <button onclick="openGradingModal('{{ $sub->id }}', '{{ $sub->nilai }}', '{{ addslashes($sub->catatan_dosen) }}')"
                                                                    class="px-3 py-1.5 bg-slate-800 hover:bg-indigo-600 text-white font-semibold text-[11px] rounded-lg transition-all duration-200 hover:-translate-y-0.5">
                                                                    <i class="fas fa-edit mr-1"></i> Nilai
                                                                </button>
                                                             </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="p-3 text-center text-slate-400 italic">Belum ada mahasiswa yang mengumpulkan tugas.</td>
                                                        </tr>
                                                    @endforelse
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-slate-200 shadow-sm">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>
                        </div>
                        <div class="relative">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chalkboard text-3xl text-slate-300"></i>
                            </div>
                            <p class="text-sm font-semibold text-slate-700">Kelas Virtual Kosong</p>
                            <p class="text-xs text-slate-400 mt-1">Mulailah dengan membuat Pertemuan Ke-1 di atas.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ================= MODALS ================= --}}
    <!-- Modal Buat Pertemuan -->
    <div id="modalPertemuan" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden transition-all duration-300">
        <div class="bg-white w-full max-w-md mx-4 p-6 rounded-2xl shadow-2xl border animate-scale-in">
            <div class="flex items-center gap-2 border-b pb-3 mb-4">
                <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-plus text-indigo-600 text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Buat Sesi Pertemuan</h3>
            </div>
            <form action="{{ route('dosen.classroom.pertemuan.store', $kelas->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Pertemuan Ke-</label>
                    <input type="number" name="pertemuan_ke" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Judul / Pokok Bahasan</label>
                    <input type="text" name="judul_topik" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" placeholder="Contoh: Pengenalan Sintaks Fundamental">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" rows="3"></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modalPertemuan')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-all">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-semibold rounded-xl transition-all hover:-translate-y-0.5">Simpan Sesi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Materi -->
    <div id="modalMateri" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-md mx-4 p-6 rounded-2xl shadow-2xl border">
            <div class="flex items-center gap-2 border-b pb-3 mb-4">
                <div class="w-8 h-8 rounded-lg bg-sky-100 flex items-center justify-center">
                    <i class="fas fa-file-upload text-sky-600 text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Unggah Materi</h3>
            </div>
            <form id="formMateri" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Judul Materi</label>
                    <input type="text" name="judul_materi" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">File Materi (PDF/PPTX/ZIP)</label>
                    <input type="file" name="file_materi" required class="w-full px-3 py-2 border border-slate-200 rounded-xl bg-slate-50 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modalMateri')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-all">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-500 hover:to-sky-600 text-white font-semibold rounded-xl transition-all hover:-translate-y-0.5">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tugas -->
    <div id="modalTugas" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-md mx-4 p-6 rounded-2xl shadow-2xl border">
            <div class="flex items-center gap-2 border-b pb-3 mb-4">
                <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-tasks text-amber-600 text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Buat Tugas</h3>
            </div>
            <form id="formTugas" action="" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Judul Tugas</label>
                    <input type="text" name="judul_tugas" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Instruksi</label>
                    <textarea name="instruksi" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all" rows="3"></textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Deadline</label>
                    <input type="datetime-local" name="deadline" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modalTugas')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-all">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-semibold rounded-xl transition-all hover:-translate-y-0.5">Publikasikan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Grading -->
    <div id="modalGrading" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-sm mx-4 p-6 rounded-2xl shadow-2xl border">
            <div class="flex items-center gap-2 border-b pb-3 mb-4">
                <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-star text-indigo-600 text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Input Nilai Tugas</h3>
            </div>
            <form id="formGrading" action="" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Skor Nilai (0-100)</label>
                    <input type="number" id="inputNilai" name="nilai" min="0" max="100" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm font-bold text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 text-xs mb-1">Catatan / Koreksi</label>
                    <textarea id="inputCatatan" name="catatan_dosen" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" rows="2" placeholder="Contoh: Hasil code sudah bagus, tingkatkan kerapian sintaks."></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modalGrading')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-all">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-semibold rounded-xl transition-all hover:-translate-y-0.5">Simpan Nilai</button>
                </div>
            </form>
        </div>
    </div>




@endsection