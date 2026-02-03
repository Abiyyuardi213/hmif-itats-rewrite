@extends('layouts.app')

@section('title', 'Pengumuman & Berita - HMIF ITATS')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-12 md:py-20 overflow-hidden bg-white mt-[-1px]">
        <!-- Radial Gradient Background -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_-20%,rgba(244,114,182,0.12),rgba(255,255,255,0))]">
        </div>

        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative">
            <!-- Badge -->
            <div
                class="inline-flex items-center gap-2 rounded-full border border-pink-100 bg-pink-50/50 px-3 py-1.5 text-[10px] font-bold text-pink-500 mb-5 backdrop-blur-sm shadow-sm uppercase tracking-widest">
                <i class="fas fa-bullhorn"></i>
                Informasi Terkini
            </div>

            <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 mb-5 leading-[1.1]">
                Pengumuman & <br>
                <span class="text-pink-500">Berita</span>
            </h1>

            <p class="text-base text-slate-500 max-w-xl mx-auto leading-relaxed font-medium mb-10 opacity-90">
                Dapatkan informasi terbaru seputar kegiatan akademik, organisasi, dan prestasi mahasiswa Teknik Informatika
                ITATS.
            </p>

            <!-- Search Bar -->
            <div class="max-w-md mx-auto">
                <div class="relative group">
                    <input type="text" placeholder="Cari informasi..."
                        class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-100 bg-white shadow-xl shadow-slate-200/20 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all text-sm font-medium">
                    <i
                        class="fas fa-search text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 group-focus-within:text-pink-500 transition-colors"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Categories -->
            <div class="flex flex-wrap gap-2 mb-10 border-b border-slate-100 pb-4">
                <button class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-semibold transition-colors">
                    Semua
                </button>
                <button
                    class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-colors">
                    Pengumuman
                </button>
                <button
                    class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-colors">
                    Berita
                </button>
                <button
                    class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-colors">
                    Prestasi
                </button>
            </div>

            <!-- Featured News (Large Card) -->
            <a href="#" class="group block mb-12">
                <div
                    class="grid md:grid-cols-2 gap-8 items-center bg-slate-50 rounded-2xl p-6 md:p-8 border border-slate-100 transition-all hover:border-primary/20 hover:shadow-xl hover:shadow-primary/5">
                    <div class="aspect-video bg-slate-200 rounded-xl overflow-hidden relative">
                        <!-- Placeholder Image -->
                        <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-300">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur text-primary text-xs font-bold rounded-full shadow-sm">
                            Berita Utama
                        </span>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-4 text-xs font-medium text-slate-500">
                            <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-700">Kegiatan</span>
                            <span>•</span>
                            <span>12 Januari 2026</span>
                        </div>
                        <h2
                            class="text-3xl font-bold text-slate-900 mb-4 group-hover:text-primary transition-colors leading-tight">
                            HMIF ITATS Sukses Gelar Festival Teknologi Informatika 2025
                        </h2>
                        <p class="text-slate-600 mb-6 line-clamp-3 leading-relaxed">
                            Acara tahunan terbesar mahasiswa informatika kembali digelar dengan meriah, menghadirkan
                            berbagai kompetisi, seminar teknologi, dan pameran karya mahasiswa yang memukau pengunjung.
                        </p>
                        <span
                            class="text-sm font-bold text-primary flex items-center gap-2 group-hover:gap-3 transition-all">
                            Baca selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Card 1 -->
                <a href="#"
                    class="group flex flex-col h-full bg-white rounded-xl border border-slate-100 overflow-hidden hover:shadow-lg hover:shadow-slate-200/50 hover:border-primary/20 transition-all">
                    <div class="h-48 bg-slate-200 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-100">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="absolute top-4 left-4 px-2 py-1 bg-white/90 backdrop-blur text-slate-700 text-[10px] font-bold rounded shadow-sm">
                            Pengumuman
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-slate-400 mb-2 block">10 Januari 2026</span>
                        <h3
                            class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Jadwal Pengisian KRS Semester Genap 2025/2026
                        </h3>
                        <p class="text-sm text-slate-500 line-clamp-3 mb-4 flex-grow">
                            Diberitahukan kepada seluruh mahasiswa Teknik Informatika bahwa jadwal pengisian KRS akan
                            dimulai pada tanggal 20 Januari 2026.
                        </p>
                        <span
                            class="text-sm font-bold text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                            Baca detail <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </a>

                <!-- Card 2 -->
                <a href="#"
                    class="group flex flex-col h-full bg-white rounded-xl border border-slate-100 overflow-hidden hover:shadow-lg hover:shadow-slate-200/50 hover:border-primary/20 transition-all">
                    <div class="h-48 bg-slate-200 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-100">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="absolute top-4 left-4 px-2 py-1 bg-white/90 backdrop-blur text-slate-700 text-[10px] font-bold rounded shadow-sm">
                            Berita
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-slate-400 mb-2 block">5 Januari 2026</span>
                        <h3
                            class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Workshop UI/UX Design bersama Praktisi Expert
                        </h3>
                        <p class="text-sm text-slate-500 line-clamp-3 mb-4 flex-grow">
                            Tingkatkan skill desain antarmuka kamu melalui workshop intensif yang diadakan oleh Divisi IPTEK
                            HMIF ITATS.
                        </p>
                        <span
                            class="text-sm font-bold text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                            Baca detail <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </a>

                <!-- Card 3 -->
                <a href="#"
                    class="group flex flex-col h-full bg-white rounded-xl border border-slate-100 overflow-hidden hover:shadow-lg hover:shadow-slate-200/50 hover:border-primary/20 transition-all">
                    <div class="h-48 bg-slate-200 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-100">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="absolute top-4 left-4 px-2 py-1 bg-white/90 backdrop-blur text-amber-600 text-[10px] font-bold rounded shadow-sm">
                            Prestasi
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-slate-400 mb-2 block">28 Desember 2025</span>
                        <h3
                            class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Tim ITATS Raih Juara 1 Hackathon Nasional 2025
                        </h3>
                        <p class="text-sm text-slate-500 line-clamp-3 mb-4 flex-grow">
                            Selamat kepada tim mahasiswa Teknik Informatika ITATS yang berhasil menyabet gelar juara dalam
                            ajang bergengsi tingkat nasional.
                        </p>
                        <span
                            class="text-sm font-bold text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                            Baca detail <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </a>

                <!-- Card 4 -->
                <a href="#"
                    class="group flex flex-col h-full bg-white rounded-xl border border-slate-100 overflow-hidden hover:shadow-lg hover:shadow-slate-200/50 hover:border-primary/20 transition-all">
                    <div class="h-48 bg-slate-200 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-100">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="absolute top-4 left-4 px-2 py-1 bg-white/90 backdrop-blur text-slate-700 text-[10px] font-bold rounded shadow-sm">
                            Pengumuman
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-slate-400 mb-2 block">25 Desember 2025</span>
                        <h3
                            class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            Libur Perkuliahan Akhir Semester
                        </h3>
                        <p class="text-sm text-slate-500 line-clamp-3 mb-4 flex-grow">
                            Informasi mengenai jadwal libur perkuliahan dan pelayanan administrasi prodi selama masa
                            liburan.
                        </p>
                        <span
                            class="text-sm font-bold text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                            Baca detail <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </a>

            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center gap-2">
                    <a href="#"
                        class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 disabled:opacity-50">
                        Sebelumnya
                    </a>
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold">1</a>
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">2</a>
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">3</a>
                    <span class="px-2 text-slate-400">...</span>
                    <a href="#"
                        class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">
                        Selanjutnya
                    </a>
                </nav>
            </div>
        </div>
    </section>
@endsection
