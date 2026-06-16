@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header Card --}}
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-indigo-900 rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-800">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-500/10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-16 -left-10 w-56 h-56 bg-emerald-500/5 rounded-full blur-2xl"></div>

            <div class="relative flex flex-col sm:flex-row items-center gap-6">
                <div
                    class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-800 border-2 border-white/10 shadow-xl flex items-center justify-center shrink-0">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center justify-center text-white text-3xl font-black">
                            {{ strtoupper(substr($namaLengkap, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="text-center sm:text-left space-y-2 flex-1">
                    <span
                        class="px-2.5 py-1 text-[10px] font-bold bg-indigo-500/10 text-indigo-300 rounded-lg border border-indigo-500/20 uppercase tracking-wider inline-flex items-center gap-1.5 shadow-sm">
                        <i class="fas fa-user-graduate text-[10px]"></i> Role:
                        {{ ucfirst(Auth::user()->role ?? 'Mahasiswa') }}
                    </span>
                    <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">{{ $namaLengkap }}</h1>
                    <p class="text-xs sm:text-sm text-slate-400 font-mono">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div
                class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl text-sm font-medium text-emerald-800 flex items-center gap-2.5">
                <i class="fas fa-check-circle text-emerald-500 text-base"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl text-sm font-medium text-rose-800">
                <div class="flex items-center gap-2.5 mb-1">
                    <i class="fas fa-exclamation-circle text-rose-500 text-base"></i> Terjadi kesalahan:
                </div>
                <ul class="list-disc pl-9 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/60">
                <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-id-card text-indigo-500"></i> Informasi Akun
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Perbarui data diri dan keamanan akun Anda</p>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" name="name" value="{{ old('name', $namaLengkap) }}" required
                            class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all bg-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-slate-300 text-xl"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="avatar"
                                class="w-full text-xs text-slate-500 bg-slate-50 border border-slate-200 p-2 rounded-xl
                                       file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold
                                       file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 file:transition-colors">
                            <p class="text-[11px] text-slate-400 mt-1.5">Format JPG / PNG, maksimal 2MB.</p>
                        </div>
                    </div>
                </div>

                {{-- GANTI HANYA DI BAGIAN SEKSI BATAS KEAMANAN KAK --}}
                <div class="border-t border-dashed border-slate-200 my-2 pt-5">
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 flex items-center gap-2">
                        <i class="fas fa-lock text-slate-400"></i> Keamanan Akun
                    </p>
                    <p class="text-[11px] text-slate-400 mb-4">Isi password lama terlebih dahulu jika Anda bermaksud
                        mengubah password baru.</p>

                    <div class="space-y-4">
                        {{-- Input Password Lama (Wajib untuk verifikasi) --}}
                        <div class="max-w-md space-y-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Password Lama
                                Saat Ini</label>
                            <input type="password" name="old_password" autocomplete="current-password"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all bg-white"
                                placeholder="Masukkan password saat ini">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password
                                    Baru</label>
                                <input type="password" name="password" autocomplete="new-password"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all bg-white"
                                    placeholder="••••••••">
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Konfirmasi
                                    Password Baru</label>
                                <input type="password" name="password_confirmation" autocomplete="new-password"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all bg-white"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold
                               transition-all duration-200 shadow-md shadow-indigo-900/20 hover:shadow-lg hover:-translate-y-0.5
                               inline-flex items-center gap-2">
                        <i class="fas fa-save text-xs"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
