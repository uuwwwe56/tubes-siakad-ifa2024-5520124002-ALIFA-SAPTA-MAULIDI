@extends('layouts.app')

@section('title', 'Persetujuan KRS Mahasiswa')

@section('content')
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-xl font-bold text-slate-900">Panel Dosen Wali</h1>
                <p class="text-sm text-slate-500 mt-0.5">Dosen: <span class="font-medium text-slate-700">{{ $dosen->nama }}</span> | NIP: <span class="font-mono text-slate-700">{{ $dosen->nip }}</span></p>
            </div>
            <div class="text-sm bg-indigo-50 text-indigo-700 px-4 py-2 rounded-xl font-semibold border border-indigo-100">
                Total Mahasiswa Bimbingan: {{ $mahasiswas->count() }} Orang
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl text-sm font-medium text-emerald-800 flex items-center">
                <i class="fas fa-check-circle text-emerald-500 mr-2.5 text-base"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider">
                            <th class="px-6 py-4">Mahasiswa</th>
                            <th class="px-6 py-4 text-center">Kelas / Angkatan</th>
                            <th class="px-6 py-4 text-center">Total SKS</th>
                            <th class="px-6 py-4 text-center">Status KRS</th>
                            <th class="px-6 py-4 text-center w-48">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                        @forelse($mahasiswas as $mhs)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800">{{ $mhs->nama }}</div>
                                    <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $mhs->npm }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-slate-600 font-medium">Kelas {{ $mhs->kelas }}</span>
                                    <div class="text-xs text-slate-400 mt-0.5">Angkatan {{ $mhs->angkatan }}</div>
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-slate-800">
                                    {{ $mhs->total_sks }} <span class="text-xs font-normal text-slate-400">SKS</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($mhs->status_krs == 'Disetujui')
                                        <span class="px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-700 text-xs font-bold border border-emerald-200">
                                            <i class="fas fa-check-circle mr-1"></i> Disetujui
                                        </span>
                                  @elseif($mhs->status_krs == 'Menunggu Persetujuan')
                                            <i class="fas fa-clock mr-1"></i> Menunggu
                                        </span>
                                    @elseif($mhs->status_krs == 'Ditolak')
                                        <span class="px-2.5 py-1 rounded-lg bg-red-100 text-red-700 text-xs font-bold border border-red-200">
                                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                                        </span>
                                    @elseif($mhs->status_krs == 'Draft')
                                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-xs font-medium border border-slate-200">
                                            <i class="fas fa-edit mr-1"></i> Draft (Belum Kirim)
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-lg bg-slate-50 text-slate-400 text-xs italic">
                                            Belum Isi KRS
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                   @if($mhs->status_krs == 'Menunggu Persetujuan')
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('dosen.krs.verifikasi', $mhs->npm) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="action" value="setujui">
                                                <button type="submit" onclick="return confirm('Setujui pengajuan KRS dari {{ $mhs->nama }}?')" class="p-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-lg border border-emerald-200 transition" title="Setujui KRS">
                                                    <i class="fas fa-check text-xs"></i> Setujui
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('dosen.krs.verifikasi', $mhs->npm) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="action" value="tolak">
                                                <button type="submit" onclick="return confirm('Tolak pengajuan KRS dari {{ $mhs->nama }} untuk diperbaiki?')" class="p-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg border border-red-200 transition" title="Tolak / Kembalikan">
                                                    <i class="fas fa-times text-xs"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 font-medium">- Tidak Ada Aksi -</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    <i class="fas fa-users text-4xl mb-3 text-slate-200 block"></i>
                                    Belum ada data mahasiswa bimbingan yang terdaftar untuk akun Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection