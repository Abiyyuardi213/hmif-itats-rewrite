@extends('layouts.app')

@section('title', 'Program Kerja - HMIF ITATS')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-20">
        <!-- Header -->
        <div class="bg-white border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Program Kerja</h1>
                        <p class="text-slate-500 mt-1">Himpunan Mahasiswa Teknik Informatika</p>
                        <p class="text-xs text-slate-400 mt-1">Periode 2025/2026</p>
                    </div>
                    <div class="text-right hidden md:block">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total
                            Program</span>
                        <span class="text-4xl font-bold text-primary">12</span>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex flex-wrap gap-2">
                    <button
                        class="px-4 py-2 rounded-full bg-primary text-white text-sm font-semibold shadow-md shadow-primary/20">
                        Semua Program
                    </button>
                    <button
                        class="px-4 py-2 rounded-full bg-white border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-colors flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai
                    </button>
                    <button
                        class="px-4 py-2 rounded-full bg-white border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-colors flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Sedang Berjalan
                    </button>
                    <button
                        class="px-4 py-2 rounded-full bg-white border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-colors flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span> Akan Datang
                    </button>
                </div>
            </div>
        </div>

        <!-- Timeline Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="relative">
                <!-- Vertical Line -->
                <div class="absolute left-6 md:left-8 top-0 bottom-0 w-0.5 bg-slate-200"></div>

                <div class="space-y-12">

                    <!-- Item 1: Completed -->
                    <div class="relative pl-20 md:pl-24">
                        <!-- Icon -->
                        <div
                            class="absolute left-2 md:left-4 top-0 w-9 h-9 md:w-11 md:h-11 rounded-full bg-white border-4 border-emerald-50 text-emerald-600 flex items-center justify-center shadow-sm z-10">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>

                        <!-- Card -->
                        <div
                            class="bg-white rounded-xl p-5 md:p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span
                                            class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase tracking-wide">Internal</span>
                                        <span class="text-xs text-slate-400">Humas</span>
                                    </div>
                                    <h3
                                        class="text-lg md:text-xl font-bold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                                        Promosi Himpunan Mahasiswa Teknik Informatika 2025
                                    </h3>
                                    <p class="text-slate-500 text-sm mb-4 line-clamp-2">
                                        Pengenalan dan pendekatan kepada mahasiswa baru Teknik Informatika angkatan 2025.
                                    </p>

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-8 text-xs text-slate-500">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            11 Oktober 2025
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            10 Panitia
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Taman Kampus
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-slate-50">
                                        <a href="#"
                                            class="text-xs font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                                            Lihat detail kegiatan
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="shrink-0">
                                    <span
                                        class="inline-flex flex-col items-center justify-center px-4 py-2 rounded-lg bg-emerald-50 border border-emerald-100 min-w-[100px]">
                                        <span
                                            class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest mb-1">SELESAI</span>
                                        <span class="text-xs font-bold text-slate-700">11 Oktober 2025</span>
                                        <span class="text-[10px] text-slate-400">10:00 - Selesai</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2: Upcoming -->
                    <div class="relative pl-20 md:pl-24">
                        <div
                            class="absolute left-2 md:left-4 top-0 w-9 h-9 md:w-11 md:h-11 rounded-full bg-white border-4 border-sky-50 text-sky-600 flex items-center justify-center shadow-sm z-10">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>

                        <div
                            class="bg-white rounded-xl p-5 md:p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span
                                            class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 text-[10px] font-bold uppercase tracking-wide">Pencarian
                                            Bakat</span>
                                        <span class="text-xs text-slate-400">PSDM</span>
                                    </div>
                                    <h3
                                        class="text-lg md:text-xl font-bold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                                        Open Recruitment
                                    </h3>
                                    <p class="text-slate-500 text-sm mb-4 line-clamp-2">
                                        Penerimaan anggota baru HMIF ITATS.
                                    </p>

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-8 text-xs text-slate-500">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            30 Juni 2025
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            50+ Calon
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Gd. A 301
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-slate-50">
                                        <a href="#"
                                            class="text-xs font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                                            Lihat detail kegiatan
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="shrink-0">
                                    <span
                                        class="inline-flex flex-col items-center justify-center px-4 py-2 rounded-lg bg-amber-50 border border-amber-100 min-w-[100px]">
                                        <span
                                            class="text-[10px] font-bold text-amber-500 uppercase tracking-widest mb-1">MINGGU</span>
                                        <span class="text-xs font-bold text-slate-700">30 Jun 2025</span>
                                        <span class="text-[10px] text-slate-400">08:00 - Selesai</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="relative pl-20 md:pl-24">
                        <div
                            class="absolute left-2 md:left-4 top-0 w-9 h-9 md:w-11 md:h-11 rounded-full bg-white border-4 border-sky-50 text-sky-600 flex items-center justify-center shadow-sm z-10">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>

                        <div
                            class="bg-white rounded-xl p-5 md:p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span
                                            class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 text-[10px] font-bold uppercase tracking-wide">Pelatihan</span>
                                        <span class="text-xs text-slate-400">PSDM</span>
                                    </div>
                                    <h3
                                        class="text-lg md:text-xl font-bold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                                        Pelatihan Manajemen dan Organisasi (PMO)
                                    </h3>
                                    <p class="text-slate-500 text-sm mb-4 line-clamp-2">
                                        Pelatihan dasar kepemimpinan dan manajemen organisasi untuk anggota baru.
                                    </p>

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-8 text-xs text-slate-500">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            31 Oktober 2025
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            40 Peserta
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Auditorium
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-slate-50">
                                        <a href="#"
                                            class="text-xs font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                                            Lihat detail kegiatan
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="shrink-0">
                                    <span
                                        class="inline-flex flex-col items-center justify-center px-4 py-2 rounded-lg bg-amber-50 border border-amber-100 min-w-[100px]">
                                        <span
                                            class="text-[10px] font-bold text-amber-500 uppercase tracking-widest mb-1">MINGGU</span>
                                        <span class="text-xs font-bold text-slate-700">31 Okt 2025</span>
                                        <span class="text-[10px] text-slate-400">09:00 - 15:00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Repeat Item Structure for Others... Just replicating specific ones from image for brevity -->

                    <!-- Item: Public Speaking -->
                    <div class="relative pl-20 md:pl-24">
                        <div
                            class="absolute left-2 md:left-4 top-0 w-9 h-9 md:w-11 md:h-11 rounded-full bg-white border-4 border-sky-50 text-sky-600 flex items-center justify-center shadow-sm z-10">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div
                            class="bg-white rounded-xl p-5 md:p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span
                                            class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 text-[10px] font-bold uppercase tracking-wide">Pelatihan</span>
                                        <span class="text-xs text-slate-400">Pengembangan Diri</span>
                                    </div>
                                    <h3
                                        class="text-lg md:text-xl font-bold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                                        Public Speaking Berkelanjutan
                                    </h3>
                                    <p class="text-slate-500 text-sm mb-4 line-clamp-2">
                                        Pelatihan public speaking intensif untuk meningkatkan kepercayaan diri.
                                    </p>
                                    <div class="mt-4 pt-4 border-t border-slate-50">
                                        <a href="#"
                                            class="text-xs font-bold text-primary hover:text-primary-hover flex items-center gap-1">Lihat
                                            detail kegiatan <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg></a>
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <span
                                        class="inline-flex flex-col items-center justify-center px-4 py-2 rounded-lg bg-amber-50 border border-amber-100 min-w-[100px]">
                                        <span
                                            class="text-[10px] font-bold text-amber-500 uppercase tracking-widest mb-1">PROGRAM</span>
                                        <span class="text-xs font-bold text-slate-700">Berkelanjutan</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item: Seminar -->
                    <div class="relative pl-20 md:pl-24">
                        <div
                            class="absolute left-2 md:left-4 top-0 w-9 h-9 md:w-11 md:h-11 rounded-full bg-white border-4 border-sky-50 text-sky-600 flex items-center justify-center shadow-sm z-10">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div
                            class="bg-white rounded-xl p-5 md:p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span
                                            class="px-2 py-0.5 rounded bg-sky-100 text-sky-700 text-[10px] font-bold uppercase tracking-wide">Pendidikan</span>
                                        <span class="text-xs text-slate-400">Akademik</span>
                                    </div>
                                    <h3
                                        class="text-lg md:text-xl font-bold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                                        Seminar Penjurusan Teknik Informatika
                                    </h3>
                                    <p class="text-slate-500 text-sm mb-4">
                                        Mengenal lebih dalam tentang peminatan yang ada di Teknik Informatika ITATS.
                                    </p>
                                    <div class="mt-4 pt-4 border-t border-slate-50">
                                        <a href="#"
                                            class="text-xs font-bold text-primary hover:text-primary-hover flex items-center gap-1">Lihat
                                            detail kegiatan <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg></a>
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <span
                                        class="inline-flex flex-col items-center justify-center px-4 py-2 rounded-lg bg-amber-50 border border-amber-100 min-w-[100px]">
                                        <span
                                            class="text-[10px] font-bold text-amber-500 uppercase tracking-widest mb-1">SABTU</span>
                                        <span class="text-xs font-bold text-slate-700">25 Nov 2025</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Stats Summary -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 p-4 md:hidden z-40">
            <div class="flex justify-between items-center text-xs">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div> 1 Selesai
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div> 0 Berjalan
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-slate-400"></div> 11 Akan Datang
                </div>
            </div>
        </div>

        <!-- Desktop Stats Floating/Fixed -->
        <div
            class="hidden md:flex fixed bottom-8 left-1/2 -translate-x-1/2 bg-white rounded-full shadow-lg border border-slate-200 px-8 py-4 z-40 gap-8">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center border border-emerald-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-slate-900">1</span>
                    <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">Selesai</span>
                </div>
            </div>
            <div class="w-px bg-slate-200 h-10"></div>
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center border border-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-slate-900">0</span>
                    <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">Sedang Berjalan</span>
                </div>
            </div>
            <div class="w-px bg-slate-200 h-10"></div>
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center border border-slate-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-slate-900">11</span>
                    <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">Akan Datang</span>
                </div>
            </div>
        </div>
    </div>
@endsection
