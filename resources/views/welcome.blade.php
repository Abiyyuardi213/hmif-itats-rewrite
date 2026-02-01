@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-10 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-8 min-h-[500px]">

                <!-- Left Side: Content -->
                <div class="lg:w-1/2 flex flex-col justify-center">
                    <!-- Tag -->
                    <div class="flex items-center gap-2 mb-6">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-primary"></span>
                        <span
                            class="text-xs uppercase tracking-wider font-semibold text-slate-500 bg-slate-100 px-2 py-1 rounded">Informatika
                            - Kolaboratif - Progresif</span>
                    </div>

                    <!-- Headline -->
                    <h1
                        class="text-5xl md:text-6xl lg:text-[4rem] font-bold tracking-tight text-slate-900 leading-[1.1] mb-6">
                        Himpunan Mahasiswa <br>
                        Informatika <br>
                        <span class="text-slate-500">Tempat bertumbuh,</span> <br>
                        <span class="text-slate-500">berjejaring,</span> <br>
                        <span class="text-slate-500">dan berkarya.</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-lg text-slate-500 mb-8 max-w-lg leading-relaxed">
                        Kami memfasilitasi pengembangan diri lewat divisi, program kerja, dan kegiatan berdampak.
                        <span class="text-slate-900 font-medium">Ikut terlibat dan jadilah bagian dari perubahan.</span>
                    </p>

                    <!-- Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="#"
                            class="px-6 py-3 bg-primary text-white font-bold rounded hover:bg-primary-hover transition-colors shadow-lg shadow-primary/20">
                            Lihat Program Kerja
                        </a>
                        <a href="#"
                            class="px-6 py-3 bg-secondary text-white font-bold rounded hover:bg-secondary-hover transition-colors shadow-lg shadow-secondary/20">
                            Jelajahi Kegiatan
                        </a>
                    </div>
                </div>

                <!-- Right Side: Bento Grid -->
                <div class="lg:w-1/2 flex flex-col gap-6">
                    <!-- Row 1: Stats -->
                    <div class="bg-white border border-slate-200 rounded-lg p-6 w-full">
                        <h3 class="text-sm font-medium text-slate-500 mb-4">Sekilas Angka</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <span class="block text-2xl font-bold text-slate-900">12+</span>
                                <span class="text-xs text-slate-500">Program</span>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <span class="block text-2xl font-bold text-slate-900">3</span>
                                <span class="text-xs text-slate-500">Divisi</span>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <span class="block text-2xl font-bold text-slate-900">30+</span>
                                <span class="text-xs text-slate-500">Anggota</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Info Cards -->
                    <div class="flex gap-6 h-full">
                        <!-- Card 1 -->
                        <div class="flex-1 bg-white border border-slate-200 rounded-lg p-6 flex flex-col justify-between">
                            <div>
                                <span class="text-xs text-slate-400 font-medium mb-2 block">Kegiatan Terdekat</span>
                                <h3 class="font-bold text-slate-900 text-lg leading-tight mb-2">Pengembangan Manajemen
                                    Organisasi</h3>
                                <p class="text-sm text-slate-500">Selasa, 13.00 - 16.30</p>
                            </div>
                            <a href="#"
                                class="text-sm font-bold text-primary hover:text-primary-hover flex items-center gap-1 mt-4">
                                Detail kegiatan
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <!-- Card 2 -->
                        <div class="flex-1 bg-white border border-slate-200 rounded-lg p-6 flex flex-col justify-between">
                            <div>
                                <span class="text-xs text-slate-400 font-medium mb-2 block">Pengumuman</span>
                                <h3 class="font-bold text-slate-900 text-lg leading-tight mb-2">Rekrutmen Anggota Baru</h3>
                                <p class="text-sm text-slate-500">Daftar hingga 31 Desember</p>
                            </div>
                            <a href="#"
                                class="text-sm font-bold text-primary hover:text-primary-hover flex items-center gap-1 mt-4">
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
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl overflow-hidden aspect-[21/9] bg-slate-200 relative">
                <!-- Placeholder for large group image -->
                <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-100">
                    <span class="flex flex-col items-center">
                        <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        FOTO BERSAMA ANGGOTA (Placeholder)
                    </span>
                </div>
                <!-- If using actual image: <img src="..." class="w-full h-full object-cover"> -->
            </div>
        </div>
    </section>

    <!-- Jelajahi HMIF Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Jelajahi HMIF</h2>
                <p class="text-slate-500">Akses cepat ke halaman yang paling sering dicari.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card -->
                <div
                    class="group bg-white rounded-lg border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>
                    <div class="pl-4">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Struktur Organisasi</h3>
                        <p class="text-sm text-slate-500 mb-6 min-h-[40px]">Kenali kepengurusan dan perannya.</p>
                        <a href="#"
                            class="text-sm font-bold text-primary group-hover:underline flex items-center gap-1">
                            Buka halaman
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="group bg-white rounded-lg border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>
                    <div class="pl-4">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Divisi</h3>
                        <p class="text-sm text-slate-500 mb-6 min-h-[40px]">Temukan minat dan komunitas belajarmu.</p>
                        <a href="#"
                            class="text-sm font-bold text-primary group-hover:underline flex items-center gap-1">
                            Buka halaman
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="group bg-white rounded-lg border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>
                    <div class="pl-4">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Program Kerja</h3>
                        <p class="text-sm text-slate-500 mb-6 min-h-[40px]">Inisiatif strategis sepanjang periode.</p>
                        <a href="#"
                            class="text-sm font-bold text-primary group-hover:underline flex items-center gap-1">
                            Buka halaman
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="group bg-white rounded-lg border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>
                    <div class="pl-4">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Kegiatan</h3>
                        <p class="text-sm text-slate-500 mb-6 min-h-[40px]">Agenda rutin dan event khusus.</p>
                        <a href="#"
                            class="text-sm font-bold text-primary group-hover:underline flex items-center gap-1">
                            Buka halaman
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="group bg-white rounded-lg border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>
                    <div class="pl-4">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Pengumuman/Berita</h3>
                        <p class="text-sm text-slate-500 mb-6 min-h-[40px]">Informasi terbaru seputar HMIF.</p>
                        <a href="#"
                            class="text-sm font-bold text-primary group-hover:underline flex items-center gap-1">
                            Buka halaman
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Features Grid -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                        <span class="text-xs uppercase tracking-wider font-medium text-slate-500">Program</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Program Unggulan</h3>
                    <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                        Rangkaian program prioritas untuk mengakselerasi kapasitas anggota.
                    </p>
                    <a href="#"
                        class="text-sm font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                        Lihat program
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                        <span class="text-xs uppercase tracking-wider font-medium text-slate-500">Kegiatan</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Kegiatan Terbaru</h3>
                    <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                        Dokumentasi kegiatan terkini dan agenda yang sedang berjalan.
                    </p>
                    <a href="#"
                        class="text-sm font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                        Jelajahi kegiatan
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                        <span class="text-xs uppercase tracking-wider font-medium text-slate-500">Info</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Pengumuman & Berita</h3>
                    <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                        Informasi penting, rilis resmi, dan liputan HMIF.
                    </p>
                    <a href="#"
                        class="text-sm font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                        Baca kabar terbaru
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
