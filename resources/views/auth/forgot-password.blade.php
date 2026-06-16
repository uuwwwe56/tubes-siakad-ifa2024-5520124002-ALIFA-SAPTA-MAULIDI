@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-8 px-4 sm:px-6">
    <div class="w-full max-w-md mx-auto">
        
        {{-- Animasi fade in --}}
        <div class="animate-fade-in-up">
            
            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-3xl">
                
                {{-- Header dengan gradient yang lebih hidup --}}
                <div class="relative bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-6 text-center text-white overflow-hidden">
                    {{-- Decorative background --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-purple-500/20 rounded-full blur-2xl -ml-16 -mb-16"></div>
                    
                    {{-- Icon dengan animasi --}}
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-900/50 mx-auto mb-4 animate-float">
                            <i class="fas fa-lock text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-extrabold tracking-tight">Lupa Password?</h3>
                        <p class="text-xs text-slate-300 mt-2 max-w-xs mx-auto">
                            Jangan khawatir, kami akan membantu Anda memulihkan akses akun
                        </p>
                    </div>
                </div>

                {{-- Body Card --}}
                <div class="p-6 sm:p-8 space-y-6">
                    
                    {{-- Info Penting dengan desain lebih menarik --}}
                    <div class="bg-amber-50/80 border-l-4 border-amber-500 rounded-xl p-4 flex gap-3 text-amber-800 backdrop-blur-sm">
                        <div class="shrink-0">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                <i class="fas fa-shield-alt text-amber-600 text-sm"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold mb-1">Keamanan Prioritas Utama</p>
                            <p class="text-xs leading-relaxed opacity-90">
                                Demi keamanan data akademik Anda, reset password hanya dapat dilakukan melalui verifikasi identitas resmi oleh pihak kampus.
                            </p>
                        </div>
                    </div>

                    {{-- Langkah-langkah --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-clipboard-list text-indigo-600 text-[10px]"></i>
                            </div>
                            <h4 class="text-xs font-bold text-slate-600 uppercase tracking-wider">Langkah Reset Password:</h4>
                        </div>
                        
                        <div class="space-y-3">
                            {{-- Step 1 --}}
                            <div class="flex gap-3 group cursor-pointer">
                                <div class="w-7 h-7 rounded-full bg-indigo-50 group-hover:bg-indigo-100 transition-colors flex items-center justify-center shrink-0">
                                    <span class="text-xs font-bold text-indigo-600">1</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-700">Siapkan Data Akun</p>
                                    <p class="text-xs text-slate-500">Siapkan <strong class="text-indigo-600">Username / NIM / NIDN</strong> Anda yang terdaftar di sistem</p>
                                </div>
                            </div>
                            
                            {{-- Step 2 --}}
                            <div class="flex gap-3 group cursor-pointer">
                                <div class="w-7 h-7 rounded-full bg-indigo-50 group-hover:bg-indigo-100 transition-colors flex items-center justify-center shrink-0">
                                    <span class="text-xs font-bold text-indigo-600">2</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-700">Hubungi Admin Kampus</p>
                                    <p class="text-xs text-slate-500">Hubungi Biro Administrasi Umum & Kepegawaian (BAUK) atau IT Support</p>
                                </div>
                            </div>
                            
                            {{-- Step 3 --}}
                            <div class="flex gap-3 group cursor-pointer">
                                <div class="w-7 h-7 rounded-full bg-indigo-50 group-hover:bg-indigo-100 transition-colors flex items-center justify-center shrink-0">
                                    <span class="text-xs font-bold text-indigo-600">3</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-700">Verifikasi & Reset</p>
                                    <p class="text-xs text-slate-500">Setelah diverifikasi, Admin akan memberikan <strong class="text-indigo-600">Password Default</strong> baru</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative my-2">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="px-3 bg-white text-slate-400">atau</span>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="space-y-3">
                        {{-- Tombol WhatsApp dengan efek lebih menarik --}}
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20SCHOOLINK,%20saya%20ingin%20mengajukan%20reset%20password%20SIAKAD.%20Berikut%20data%20saya:%0A%0ANama%20Lengkap:%20%0AUsername/NIM/NIDN:%20%0AProdi/Fakultas:%20%0AAlasan%20Reset:%20Lupa%20Password" 
                           target="_blank"
                           class="group w-full bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 transition-all duration-300 text-white py-3.5 px-4 rounded-xl text-sm font-bold flex items-center justify-center gap-3 shadow-lg shadow-emerald-900/30 hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fab fa-whatsapp text-lg group-hover:scale-110 transition-transform duration-300"></i> 
                            Hubungi BAUK via WhatsApp
                            <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>

                        {{-- Tombol Kembali ke Login --}}
                        <a href="{{ route('login') }}" 
                           class="w-full bg-slate-100 hover:bg-slate-200 transition-all duration-200 text-slate-700 py-3 px-4 rounded-xl text-sm font-semibold flex items-center justify-center gap-2">
                            <i class="fas fa-arrow-left text-xs"></i>
                            Kembali ke Halaman Login
                        </a>
                    </div>

                    {{-- Kontak alternatif --}}
                    <div class="text-center pt-2">
                        <p class="text-[10px] text-slate-400">
                            <i class="fas fa-envelope mr-1"></i> Atau email ke: 
                            <a href="mailto:support@schoolink.sch.id" class="text-indigo-500 hover:text-indigo-600 font-medium">support@schoolink.sch.id</a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Footer info tambahan --}}
            <div class="text-center mt-6">
                <p class="text-[11px] text-slate-400">
                    <i class="fas fa-database mr-1"></i> Sistem Informasi Akademik SCHOOLINK v3.0
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-8px);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Hover effect for cards */
    .hover\:shadow-3xl:hover {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    /* Responsive */
    @media (max-width: 640px) {
        .animate-fade-in-up {
            animation-duration: 0.3s;
        }
    }
</style>

{{-- Optional: Tambahkan script untuk validasi sederhana --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efek tambahan untuk interaksi
        const cards = document.querySelectorAll('.group');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                // Optional: tambah efek ripple atau tracking
                console.log('User mengakses menu bantuan');
            });
        });
    });
</script>

@endsection