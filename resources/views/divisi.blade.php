@extends('layouts.app')

@section('title', 'Divisi - HMIF ITATS')

@section('content')
    <!-- Hero Section -->
    <section class="py-16 md:py-20 bg-slate-50 border-b border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-50 border border-pink-100 mb-8">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                <span class="text-sm font-bold text-primary">Struktur Organisasi</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-4 tracking-tight">
                Divisi Himpunan <br>
                <span class="text-primary">Mahasiswa</span>
            </h1>

            <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Mengenal lebih dekat struktur organisasi dan anggota dari setiap divisi dalam himpunan mahasiswa kami
            </p>
        </div>
    </section>

    <!-- Divisions Grid -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">

                <!-- Divisi Pengembangan SDM (Blue) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 p-6 md:p-8 flex flex-col h-full"
                    id="divisi-psdm">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-bold border border-amber-200">
                            9 Anggota
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-2">Divisi Pengembangan SDM</h3>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">
                        Mengelola kegiatan akademik dan pengembangan intelektual mahasiswa
                    </p>

                    <!-- Coordinator -->
                    <div class="bg-red-50/50 rounded-xl p-4 border border-red-100 mb-6 flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-primary font-bold text-sm">
                            FA
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Firman Ardiansyah</h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span
                                    class="text-xs px-2 py-0.5 rounded bg-pink-100 text-primary font-bold">Koordinator</span>
                            </div>
                        </div>
                    </div>

                    <!-- Members List -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <!-- Member 1 -->
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                HAL</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Hasan Abdul Latif</p>
                                <p class="text-xs text-slate-400">Anggota</p>
                                <div class="mt-1 flex flex-col gap-0.5">
                                    <span class="text-[10px] text-slate-400 flex items-center gap-1"><svg
                                            class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg> example@example.com</span>
                                </div>
                            </div>
                        </div>
                        <!-- Member 2 -->
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                RER</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Raasyitha Elga Rolobessy</p>
                                <p class="text-xs text-slate-400">Anggota</p>
                                <div class="mt-1 flex flex-col gap-0.5">
                                    <span class="text-[10px] text-slate-400 flex items-center gap-1"><svg
                                            class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg> example@example.com</span>
                                </div>
                            </div>
                        </div>
                        <!-- Member 3 -->
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                MAP</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Madadina Adilah Pamuji</p>
                                <p class="text-xs text-slate-400">Anggota</p>
                                <div class="mt-1 flex flex-col gap-0.5">
                                    <span class="text-[10px] text-slate-400 flex items-center gap-1"><svg
                                            class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg> example@example.com</span>
                                </div>
                            </div>
                        </div>
                        <!-- Member 4 -->
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                MYF</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Maria Yesinta Fernanda</p>
                                <p class="text-xs text-slate-400">Anggota</p>
                                <div class="mt-1 flex flex-col gap-0.5">
                                    <span class="text-[10px] text-slate-400 flex items-center gap-1"><svg
                                            class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg> example@example.com</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Members -->
                        <div class="hidden-members hidden contents">
                            <!-- Member 5 -->
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    DDS</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Danu Dwi Saputra</p>
                                    <p class="text-xs text-slate-400">Anggota</p>
                                    <div class="mt-1 flex flex-col gap-0.5">
                                        <span class="text-[10px] text-slate-400 flex items-center gap-1"><svg
                                                class="w-2.5 h-2.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg> example@example.com</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Member 6 -->
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    ARM</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Achmad Rizqi Mubarok</p>
                                    <p class="text-xs text-slate-400">Anggota</p>
                                </div>
                            </div>
                            <!-- Member 7 -->
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    ASKA</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Aryo Syarif Kamal Akbar</p>
                                    <p class="text-xs text-slate-400">Anggota</p>
                                </div>
                            </div>
                            <!-- Member 8 -->
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    GAPU</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Gansa Alega Putra Utomo</p>
                                    <p class="text-xs text-slate-400">Anggota</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 text-center">
                        <button onclick="toggleMembers(this, 'divisi-psdm')"
                            class="text-sm font-bold text-primary hover:text-primary-hover transition-colors">
                            Lihat Detail Anggota
                        </button>
                    </div>
                </div>

                <!-- Divisi Media Digital (Purple) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 p-6 md:p-8 flex flex-col h-full"
                    id="divisi-medinfo">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-bold border border-amber-200">
                            8 Anggota
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-2">Divisi Media Digital & Hubungan Masyarakat</h3>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">
                        Menjalin komunikasi dan kerjasama dengan pihak eksternal
                    </p>

                    <!-- Coordinator -->
                    <div class="bg-purple-50/50 rounded-xl p-4 border border-purple-100 mb-6 flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-primary font-bold text-sm">
                            TAZ
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Tarishah Aridhah Zhafirah</h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span
                                    class="text-xs px-2 py-0.5 rounded bg-pink-100 text-primary font-bold">Koordinator</span>
                                <span class="text-[10px] text-slate-400">Komunikasi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Members List -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                AMI</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Ahmad Maulana Ismaindra</p>
                                <p class="text-xs text-slate-400">Public Relations</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                TK</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Timy Kakeru</p>
                                <p class="text-xs text-slate-400">Public Relations</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                RRP</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Rafly Rizky Pratama</p>
                                <p class="text-xs text-slate-400">Public Relations</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                MFM</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">M. Farhan Magribi</p>
                                <p class="text-xs text-slate-400">Public Relations</p>
                            </div>
                        </div>

                        <!-- Hidden Members Mockup as this has 8 members -->
                        <div class="hidden-members hidden contents">
                            <!-- Mock Hidden Member 5 -->
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    EX1</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Member Ekstra 1</p>
                                    <p class="text-xs text-slate-400">Media Digital</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    EX2</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Member Ekstra 2</p>
                                    <p class="text-xs text-slate-400">Media Digital</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    EX3</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Member Ekstra 3</p>
                                    <p class="text-xs text-slate-400">Media Digital</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 text-center">
                        <button onclick="toggleMembers(this, 'divisi-medinfo')"
                            class="text-sm font-bold text-primary hover:text-primary-hover transition-colors">
                            Lihat Detail Anggota
                        </button>
                    </div>
                </div>

                <!-- Divisi Litbang (Green) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 p-6 md:p-8 flex flex-col h-full"
                    id="divisi-litbang">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-bold border border-amber-200">
                            8 Anggota
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-2">Divisi Penelitian dan Pengembangan</h3>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">
                        Fokus pada kemampuan ilmiah dan teknologi (IPTEK), menghasilkan temuan baru, serta meningkatkan
                        keahlian (soft skill dan hard skill) anggota
                    </p>

                    <!-- Coordinator -->
                    <div class="bg-emerald-50/50 rounded-xl p-4 border border-emerald-100 mb-6 flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-primary font-bold text-sm">
                            ASA
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Amelya Sofia Anggraini</h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span
                                    class="text-xs px-2 py-0.5 rounded bg-pink-100 text-primary font-bold">Koordinator</span>
                                <span class="text-[10px] text-slate-400">Litbang</span>
                            </div>
                        </div>
                    </div>

                    <!-- Members List -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                HSN</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Haza Satria Nagari</p>
                                <p class="text-xs text-slate-400">Litbang</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                NZEA</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Nazwa Zahira Eka Aryanto</p>
                                <p class="text-xs text-slate-400">Litbang</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                KRL</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Khalifullah Rafiuddin Lukman</p>
                                <p class="text-xs text-slate-400">Litbang</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                MNRA</div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Muhammad Naufal Rizky. A</p>
                                <p class="text-xs text-slate-400">Litbang</p>
                            </div>
                        </div>

                        <!-- Hidden Members -->
                        <div class="hidden-members hidden contents">
                            <!-- Mock Hidden Member 5 -->
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    EX1</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Member Ekstra 1</p>
                                    <p class="text-xs text-slate-400">Litbang</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    EX2</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Member Ekstra 2</p>
                                    <p class="text-xs text-slate-400">Litbang</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                    EX3</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">Member Ekstra 3</p>
                                    <p class="text-xs text-slate-400">Litbang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 text-center">
                        <button onclick="toggleMembers(this, 'divisi-litbang')"
                            class="text-sm font-bold text-primary hover:text-primary-hover transition-colors">
                            Lihat Detail Anggota
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function toggleMembers(button, cardId) {
            // Find the card container
            const card = document.getElementById(cardId);
            // Find the hidden members container within this card
            const hiddenMembers = card.querySelector('.hidden-members');

            // Toggle hidden class
            if (hiddenMembers.classList.contains('hidden')) {
                // Show members
                hiddenMembers.classList.remove('hidden');
                button.innerText = 'Tutup Detail';
                button.classList.add('text-slate-400');
                // button.classList.remove('text-primary'); // Option: Change color if desired
            } else {
                // Hide members
                hiddenMembers.classList.add('hidden');
                button.innerText = 'Lihat Detail Anggota';
                button.classList.remove('text-slate-400');
                // button.classList.add('text-primary');
            }
        }
    </script>
@endsection
