@extends('layouts.app')

@section('title', 'Ruang Kelas')
@section('styles')
    <script src="{{ asset('js/mhs.cl.show.js') }}"></script>
@endsection
@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-800">
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-16 -left-10 w-56 h-56 bg-emerald-500/5 rounded-full blur-2xl"></div>

        <div class="relative">
            <span class="px-2.5 py-1 text-[10px] font-bold bg-indigo-500/10 text-indigo-300 rounded-lg border border-indigo-500/20 uppercase tracking-wider inline-flex items-center gap-1.5 shadow-sm">
                <i class="fas fa-chalkboard text-[10px]"></i> Ruang Kuliah Mahasiswa
            </span>
            <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight mt-2">{{ $kelas->matakuliah->nama_matakuliah }}</h1>
            <p class="text-xs sm:text-sm text-slate-400 font-medium mt-1 flex items-center gap-1.5">
                <i class="fas fa-user-tie text-indigo-400"></i> {{ $kelas->dosen->nama }}
                <span class="mx-1 text-slate-700">•</span>
                Kelas <span class="text-slate-300 font-semibold">{{ $kelas->kelas }}</span>
            </p>
        </div>
    </div>

    {{-- Pertemuan List --}}
    <div class="space-y-6">
        @forelse($pertemuans as $ptm)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

                {{-- Pertemuan Header --}}
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/60 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-600">
                            Pertemuan {{ $ptm->pertemuan_ke }}
                        </span>
                        <h2 class="text-sm font-bold text-slate-800 mt-1.5">{{ $ptm->judul_topik }}</h2>
                    </div>

                    <div class="bg-white p-2 rounded-xl border border-slate-200 flex items-center gap-2.5 shadow-sm">
                        <span class="text-[11px] font-bold text-slate-500 ml-1 inline-flex items-center gap-1.5">
                            <i class="fas fa-user-check text-emerald-500"></i> Status Absen:
                        </span>

                        @if($ptm->absensis->isNotEmpty())
                            @php $statusUser = $ptm->absensis->first()->status; @endphp
                            <span class="px-3 py-1 text-[11px] font-bold rounded-lg uppercase shadow-sm inline-flex items-center gap-1.5
                                {{ $statusUser == 'hadir' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                {{ $statusUser == 'izin' ? 'bg-amber-100 text-amber-800' : '' }}
                                {{ $statusUser == 'sakit' ? 'bg-sky-100 text-sky-800' : '' }}
                                {{ $statusUser == 'alfa' ? 'bg-rose-100 text-rose-800' : '' }}">
                                <i class="fas fa-check-double"></i> {{ $statusUser }} (Berhasil Dicatat)
                            </span>
                        @elseif($ptm->is_absensi_active)
                            <form action="{{ route('mahasiswa.classroom.absensi.store', $ptm->id) }}" method="POST" class="flex items-center gap-1.5 text-xs">
                                @csrf
                                <select name="status" required class="px-2.5 py-1.5 border border-indigo-200 rounded-lg text-xs bg-white text-slate-700 font-bold focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alfa">Alfa</option>
                                </select>
                                <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                                    Kirim Absen
                                </button>
                            </form>
                        @else
                            <span class="px-3 py-1.5 bg-slate-100 text-slate-500 text-[11px] font-semibold rounded-lg italic inline-flex items-center gap-1.5">
                                <i class="fas fa-lock text-slate-400"></i> Absensi Belum Dibuka Dosen
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Pertemuan Body --}}
                <div class="p-6 space-y-4">
                    <p class="text-xs text-slate-500">{{ $ptm->deskripsi ?? 'Tidak ada deskripsi pengantar.' }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Materi --}}
                        <div class="bg-slate-50/70 rounded-xl p-4 border border-slate-100 space-y-2.5">
                            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1.5">
                                <i class="fas fa-book-open text-sky-500"></i> Materi Perkuliahan
                            </h4>
                            @forelse($ptm->materis as $mat)
                                <div class="flex justify-between items-center gap-2 bg-white p-2.5 rounded-lg border border-slate-200 text-xs hover:border-indigo-200 transition-colors">
                                    <span class="font-medium text-slate-700 truncate flex items-center gap-1.5">
                                        <i class="far fa-file-alt text-slate-400 shrink-0"></i> {{ $mat->judul_materi }}
                                    </span>
                                    <a href="{{ asset('storage/' . $mat->file_path) }}" target="_blank" class="text-indigo-600 font-bold hover:text-indigo-700 hover:underline shrink-0 inline-flex items-center gap-1">
                                        <i class="fas fa-download text-[10px]"></i> Unduh
                                    </a>
                                </div>
                            @empty
                                <p class="text-xs text-slate-400 italic">Belum ada file materi terunggah.</p>
                            @endforelse
                        </div>

                        {{-- Tugas --}}
                        <div class="bg-slate-50/70 rounded-xl p-4 border border-slate-100 space-y-3">
                            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1.5">
                                <i class="fas fa-clipboard-list text-amber-500"></i> Tugas Kuliah
                            </h4>
                            @forelse($ptm->tugases as $tgs)
                                <div class="bg-white p-3 rounded-lg border border-slate-200 text-xs space-y-2 shadow-sm">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $tgs->judul_tugas }}</p>
                                        <p class="text-slate-500 font-mono text-[11px] mt-0.5">{{ $tgs->instruksi }}</p>
                                        <p class="text-rose-600 font-bold mt-1.5 text-[11px] inline-flex items-center gap-1">
                                            <i class="fas fa-clock"></i> Batas: {{ date('d M Y, H:i', strtotime($tgs->deadline)) }} WIB
                                        </p>
                                    </div>

                                    @php $mySub = $tgs->submissions->first(); @endphp
                                    <div class="pt-2 border-t border-dashed border-slate-200 space-y-2">

                                        @if($mySub)
                                            <div class="p-2.5 bg-emerald-50 rounded-lg border border-emerald-200 text-[11px] text-emerald-800 space-y-1.5">
                                                <p class="font-bold flex items-center gap-1.5"><i class="fas fa-check-circle text-emerald-600"></i> Sudah Dikumpulkan</p>
                                                <a href="{{ asset('storage/' . $mySub->file_jawaban) }}" target="_blank" class="block text-indigo-600 font-semibold hover:underline inline-flex items-center gap-1">
                                                    <i class="fas fa-external-link-alt text-[10px]"></i> Lihat File Anda
                                                </a>

                                                @if($mySub->nilai)
                                                    <div class="mt-2 p-1.5 bg-indigo-600 text-white font-bold rounded-lg text-center text-xs shadow-sm">
                                                        Nilai Dosen: {{ $mySub->nilai }}
                                                    </div>
                                                    <p class="text-slate-500 text-[10px] mt-1">Catatan Dosen: "{{ $mySub->catatan_dosen ?? '-' }}"</p>
                                                    <span class="block mt-1 text-center font-mono font-bold text-[10px] text-rose-600 uppercase tracking-wide bg-rose-50 p-1.5 rounded-lg border border-rose-200">
                                                        <i class="fas fa-lock"></i> Kunci Permanen (Sudah Dinilai)
                                                    </span>
                                                @else
                                                    <p class="text-slate-400 text-[10px] italic pt-1">Menunggu penilaian dosen...</p>

                                                    <div class="flex items-center gap-2 pt-2 border-t border-emerald-200/50">
                                                        <button type="button" onclick="toggleEditForm('{{ $tgs->id }}')" class="flex-1 py-1.5 px-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-lg text-center transition-all duration-200 flex items-center justify-center gap-1 shadow-sm hover:-translate-y-0.5">
                                                            <i class="fas fa-edit"></i> Edit Tugas
                                                        </button>

                                                       <form action="{{ url('/mahasiswa/classroom/tugas/' . $mySub->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jawaban tugas ini?')" class="flex-1 m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="w-full py-1.5 px-2 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-lg text-center transition-all duration-200 flex items-center justify-center gap-1 shadow-sm hover:-translate-y-0.5">
                                                                <i class="fas fa-trash-alt"></i> Hapus Tugas
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>

                                            @if(!$mySub->nilai)
                                                <div id="edit-form-{{ $tgs->id }}" class="hidden p-3 bg-amber-50/60 rounded-lg border border-amber-200 mt-2 space-y-2">
                                                    <div class="flex justify-between items-center border-b border-amber-200 pb-1.5">
                                                        <span class="font-bold text-amber-700 text-[11px] inline-flex items-center gap-1.5"><i class="fas fa-pen"></i> Mode Edit Jawaban</span>
                                                        <button type="button" onclick="toggleEditForm('{{ $tgs->id }}')" class="text-slate-400 hover:text-slate-600 font-bold leading-none text-base">&times;</button>
                                                    </div>
                                                  <form action="{{ url('/mahasiswa/classroom/tugas/' . $mySub->id) }}" method="POST" enctype="multipart/form-data" class="space-y-1.5 pt-1.5">
                                                        @csrf
                                                        @method('PUT')
                                                        <label class="block text-[11px] font-bold text-slate-600">Pilih File Baru (PDF/JPG, Maks 2MB):</label>
                                                        <input type="file" name="file_jawaban" required class="w-full text-[11px] bg-white border border-slate-200 p-1.5 rounded-lg file:mr-2 file:py-0.5 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:font-bold file:bg-slate-200 file:text-slate-700">
                                                        <input type="text" name="catatan_mahasiswa" value="{{ $mySub->catatan_mahasiswa }}" placeholder="Catatan opsional untuk dosen..." class="w-full px-2.5 py-1.5 border border-slate-200 rounded-lg text-[11px] bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                                                        <button type="submit" class="w-full py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg text-[11px] transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                                                            Simpan Perubahan
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif

                                        @else
                                            <form action="{{ route('mahasiswa.classroom.tugas.submit', $tgs->id) }}" method="POST" enctype="multipart/form-data" class="space-y-1.5">
                                                @csrf
                                                <label class="block text-[11px] font-bold text-slate-600">Unggah Jawaban Tugas (PDF/JPG, Maks 2MB):</label>
                                                <input type="file" name="file_jawaban" required class="w-full text-[11px] bg-slate-50 border border-slate-200 p-1.5 rounded-lg file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:font-bold file:bg-slate-200 file:text-slate-700">
                                                <input type="text" name="catatan_mahasiswa" placeholder="Catatan opsional untuk dosen..." class="w-full px-2.5 py-1.5 border border-slate-200 rounded-lg text-[11px] focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                                                <button type="submit" class="w-full py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-[11px] tracking-wide transition-all duration-200 shadow-sm hover:-translate-y-0.5">
                                                    <i class="fas fa-paper-plane mr-1"></i> Kirim Tugas Sekarang
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-slate-400 italic">Tidak ada penugasan.</p>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl p-12 text-center text-slate-400 border border-dashed border-slate-200">
                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chalkboard text-2xl text-slate-300"></i>
                </div>
                <p class="text-sm font-medium text-slate-500">Materi dan pertemuan kelas belum diterbitkan oleh dosen pengampu.</p>
            </div>
        @endforelse
    </div>
</div>


@endsection