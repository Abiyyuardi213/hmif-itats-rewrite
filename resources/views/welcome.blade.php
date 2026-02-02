@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 bg-white overflow-hidden">
        <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
            <div class="flex flex-col lg:flex-row gap-16 items-start">

                <!-- Left Side: Content -->
                <div class="lg:w-1/2 flex flex-col pt-4">
                    <!-- Tag/Badge -->
                    <div
                        class="inline-flex items-center gap-2 mb-8 bg-white border border-slate-100 px-3 py-1 rounded-full w-fit shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                        <span class="text-[11px] font-medium text-slate-500 tracking-tight">Informatika • Kolaboratif •
                            Progresif</span>
                    </div>

                    <!-- Headline -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900 leading-[1.2] mb-8">
                        Himpunan Mahasiswa <br>
                        Informatika <br>
                        <span class="text-slate-400 font-medium">Tempat bertumbuh, <br>
                            berjejaring, dan berkarya.</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-base text-slate-500 mb-10 max-w-lg leading-relaxed">
                        Kami memfasilitasi pengembangan diri lewat divisi, program kerja, dan kegiatan berdampak.
                        Ikut terlibat dan jadilah bagian dari perubahan.
                    </p>

                    <!-- Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="#"
                            class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:opacity-90 transition-all text-sm shadow-sm">
                            Lihat Program Kerja
                        </a>
                        <a href="#"
                            class="px-6 py-3 bg-secondary text-white font-bold rounded-lg hover:opacity-90 transition-all text-sm shadow-sm">
                            Jelajahi Kegiatan
                        </a>
                    </div>
                </div>

                <!-- Right Side: Cards Grid -->
                <div class="lg:w-1/2 w-full flex flex-col gap-6">
                    <!-- Stats Card -->
                    <div class="bg-slate-50/50 border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-xs font-medium text-slate-500 mb-5">Sekilas Angka</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm">
                                <span class="block text-2xl font-bold text-slate-900 mb-0.5 tracking-tight">12+</span>
                                <span class="text-[11px] text-slate-400">Program</span>
                            </div>
                            <div class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm">
                                <span class="block text-2xl font-bold text-slate-900 mb-0.5 tracking-tight">3</span>
                                <span class="text-[11px] text-slate-400">Divisi</span>
                            </div>
                            <div class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm">
                                <span class="block text-2xl font-bold text-slate-900 mb-0.5 tracking-tight">30+</span>
                                <span class="text-[11px] text-slate-400">Anggota</span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Cards Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Card 1 -->
                        <div
                            class="bg-slate-50/50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between min-h-[140px]">
                            <div>
                                <span class="text-[11px] font-medium text-slate-500 mb-3 block">Kegiatan
                                    Terdekat</span>
                                <h3 class="font-bold text-slate-900 text-lg leading-tight mb-2">Pengembangan Manajemen
                                    Organisasi</h3>
                                <p class="text-xs text-slate-500">Selasa, 13.00 - 16.30</p>
                            </div>
                            <a href="#" class="inline-flex items-center gap-1 text-sm font-bold text-primary mt-4">
                                Detail kegiatan
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <!-- Card 2 -->
                        <div
                            class="bg-slate-50/50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between min-h-[140px]">
                            <div>
                                <span class="text-[11px] font-medium text-slate-500 mb-3 block">Pengumuman</span>
                                <h3 class="font-bold text-slate-900 text-lg leading-tight mb-2">Rekrutmen Anggota Baru
                                </h3>
                                <p class="text-xs text-slate-500">Daftar hingga 31 Desember</p>
                            </div>
                            <a href="#" class="inline-flex items-center gap-1 text-sm font-bold text-primary mt-4">
                                Lihat pengumuman
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Section -->
    <section class="pb-20 bg-white">
        <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
            <div
                class="rounded-[2rem] overflow-hidden aspect-[21/9] bg-slate-100 relative shadow-2xl shadow-slate-200/50 border border-slate-200">
                <img src="{{ asset('image/wisuda72.png') }}" alt="HMIF Group Photo" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            </div>
        </div>
    </section>

    <!-- Jelajahi HMIF Section -->
    <section class="py-24 bg-slate-50/50 border-y border-slate-100">
        <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
            <div class="mb-14 text-center">
                <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">Jelajahi HMIF</h2>
                <div class="w-12 h-1 bg-primary mx-auto rounded-full mb-4"></div>
                <p class="text-slate-500 font-medium">Akses cepat ke halaman yang paling sering dicari.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card -->
                <div
                    class="group bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Struktur Organisasi</h3>
                    <p class="text-sm text-slate-500 mb-8 leading-relaxed font-medium">Kenali kepengurusan dan perannya
                        dalam menjalankan roda organisasi.</p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-sm font-bold text-primary group-hover:gap-3 transition-all">
                        Buka halaman
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div
                    class="group bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Divisi</h3>
                    <p class="text-sm text-slate-500 mb-8 leading-relaxed font-medium">Temukan minat dan komunitas
                        belajarmu di berbagai divisi yang tersedia.</p>
                    <a href="{{ url('/struktur-organisasi') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-primary group-hover:gap-3 transition-all">
                        Buka halaman
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <div
                    class="group bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Program Kerja</h3>
                    <p class="text-sm text-slate-500 mb-8 leading-relaxed font-medium">Inisiatif strategis sepanjang
                        periode untuk mencapai visi HMIF.</p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-sm font-bold text-primary group-hover:gap-3 transition-all">
                        Buka halaman
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Features Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div
                    class="bg-slate-50 rounded-[2rem] p-10 border border-slate-100 flex flex-col hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2 h-2 rounded-full bg-primary shadow-sm shadow-primary/50"></span>
                        <span class="text-xs uppercase tracking-widest font-bold text-slate-400">Program</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 leading-tight">Program Unggulan</h3>
                    <p class="text-[15px] text-slate-500 mb-8 leading-relaxed font-medium">
                        Rangkaian program prioritas untuk mengakselerasi kapasitas anggota dan memberikan dampak nyata.
                    </p>
                    <a href="#" class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-primary group">
                        Lihat program
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-slate-50 rounded-[2rem] p-10 border border-slate-100 flex flex-col hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2 h-2 rounded-full bg-secondary shadow-sm shadow-secondary/50"></span>
                        <span class="text-xs uppercase tracking-widest font-bold text-slate-400">Kegiatan</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 leading-tight">Kegiatan Terbaru</h3>
                    <p class="text-[15px] text-slate-500 mb-8 leading-relaxed font-medium">
                        Dokumentasi kegiatan terkini dan agenda yang sedang berjalan di lingkungan Teknik Informatika.
                    </p>
                    <a href="#" class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-primary group">
                        Jelajahi kegiatan
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-slate-50 rounded-[2rem] p-10 border border-slate-100 flex flex-col hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2 h-2 rounded-full bg-slate-900 shadow-sm shadow-slate-900/50"></span>
                        <span class="text-xs uppercase tracking-widest font-bold text-slate-400">Info</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4 leading-tight">Pengumuman & Berita</h3>
                    <p class="text-[15px] text-slate-500 mb-8 leading-relaxed font-medium">
                        Informasi penting, rilis resmi, dan liputan berbagai agenda HMIF Teknik Informatika ITATS.
                    </p>
                    <a href="#" class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-primary group">
                        Baca kabar terbaru
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
