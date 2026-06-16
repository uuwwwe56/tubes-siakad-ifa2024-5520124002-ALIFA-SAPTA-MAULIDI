@extends('layouts.app')

@section('title', 'Profil Saya - Admin')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6 animate-fade-in">

        {{-- Header Card Premium - Admin (Dark Slate to Crimson Red) --}}
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-950 to-red-950 rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-800">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-red-500/10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-16 -left-10 w-56 h-56 bg-slate-500/5 rounded-full blur-2xl"></div>

            <div class="relative flex flex-col sm:flex-row items-center gap-6">
                {{-- Avatar Wadah Premium --}}
                <div
                    class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-800 border-2 border-white/10 shadow-xl flex items-center justify-center shrink-0">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-tr from-red-600 to-rose-700 flex items-center justify-center text-white text-2xl font-black uppercase">
                            {{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}
                        </div>
                    @endif
                </div>

                {{-- User Info Admin --}}
                <div class="text-center sm:text-left space-y-2 flex-1">
                    <span
                        class="px-2.5 py-1 text-[10px] font-bold bg-red-500/10 text-red-300 rounded-lg border border-red-500/20 uppercase tracking-wider inline-flex items-center gap-1.5 shadow-sm">
                        <i class="fas fa-user-shield text-[10px]"></i> Role: Administrator
                    </span>
                    <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">{{ $user->name }}</h1>
                    <p class="text-xs sm:text-sm text-slate-400 font-mono">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div
                class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl text-sm font-medium text-emerald-800 flex items-center gap-2.5 shadow-sm">
                <i class="fas fa-check-circle text-emerald-500 text-base"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi Validasi Error --}}
        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl text-sm font-medium text-rose-800 shadow-sm">
                <div class="flex items-center gap-2.5 mb-1">
                    <i class="fas fa-exclamation-circle text-rose-500 text-base"></i> Terjadi kesalahan validasi:
                </div>
                <ul class="list-disc pl-9 space-y-0.5 text-xs text-rose-700 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Pengaturan Akun Admin --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/60">
                <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-sliders-h text-red-500"></i> Informasi Profil Utama Admin
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Perbarui nama lengkap, berkas identitas foto utama, serta
                    proteksi keamanan sandi sistem</p>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Input Nama Lengkap dengan Ikon --}}
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap
                        Admin</label>
                    <div class="relative">
                        <i class="fas fa-user-circle absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all bg-white"
                            placeholder="Masukkan nama administrator utama">
                    </div>
                </div>

                {{-- Input Unduh Gambar / Avatar --}}
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Foto Profil
                        Administrator</label>
                    <div
                        class="flex flex-col sm:flex-row sm:items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-200/60">
                        <div
                            class="w-14 h-14 rounded-xl overflow-hidden bg-white border border-slate-200 flex items-center justify-center shrink-0 shadow-sm">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user-shield text-slate-300 text-xl"></i>
                            @endif
                        </div>
                        <div class="flex-1 space-y-1">
                            <input type="file" name="avatar"
                                class="w-full text-xs text-slate-500 bg-white border border-slate-200 p-2 rounded-xl
                                       file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold
                                       file:bg-red-50 file:text-red-600 hover:file:bg-red-100 file:transition-colors">
                            <p class="text-[11px] text-slate-400 pl-1">Format dokumen yang diizinkan: JPG, JPEG, atau PNG
                                (Maks. 2MB)</p>
                        </div>
                    </div>
                </div>

                {{-- GANTI HANYA DI BAGIAN SEKSI SEBELUM TOMBOL SUBMIT --}}
                <div class="border-t border-dashed md:col-span-2 my-2"></div>

                <div class="space-y-1 md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700">Password Lama Saat Ini</label>
                    <input type="password" name="old_password" autocomplete="current-password"
                        class="w-full md:w-1/2 px-3 py-2 border rounded-xl text-xs focus:ring-1 focus:ring-red-500 outline-none"
                        placeholder="Masukkan password saat ini">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-700">Password Baru Utama</label>
                    <input type="password" name="password" autocomplete="new-password"
                        class="w-full px-3 py-2 border rounded-xl text-xs focus:ring-1 focus:ring-red-500 outline-none"
                        placeholder="••••••••">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-700">Konfirmasi Password Baru Utama</label>
                    <input type="password" name="password_confirmation" autocomplete="new-password"
                        class="w-full px-3 py-2 border rounded-xl text-xs focus:ring-1 focus:ring-red-500 outline-none"
                        placeholder="••••••••">
                </div>

                {{-- Tombol Pengesahan Akun --}}
                <div class="pt-2 flex justify-end">
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-bold
                               transition-all duration-200 shadow-md shadow-red-900/10 hover:shadow-lg hover:-translate-y-0.5
                               inline-flex items-center justify-center gap-2">
                        <i class="fas fa-shield-alt text-xs"></i> Simpan Konfirmasi Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
