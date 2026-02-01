@extends('layouts.app')

@section('title', 'Recap Kegiatan - HMIF ITATS')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 lg:py-24 bg-slate-50 border-b border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Logo/Badge -->
            <div
                class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center p-1 shadow-lg shadow-pink-100 mb-8 border border-pink-100">
                <div class="w-full h-full rounded-full bg-pink-50 flex items-center justify-center">
                    <span class="text-xl font-bold text-primary">HMIF</span>
                </div>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-4 tracking-tight leading-tight">
                Recap Kegiatan <br>
                <span class="text-primary">Himpunan Mahasiswa</span>
            </h1>

            <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed mb-8">
                Dokumentasi lengkap program kerja dan kegiatan yang telah berhasil dilaksanakan oleh Himpunan Mahasiswa
                Teknik Informatika ITATS
            </p>

            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                PERIODE 2024 • TEKNIK INFORMATIKA • ITATS
            </p>
        </div>
    </section>

    <!-- Stats Grid -->
    <section class="bg-white transform -translate-y-12 mb-[-3rem]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
                <!-- Stat 1 -->
                <div class="bg-white rounded-xl p-8 border border-slate-100 shadow-sm text-center card-hover">
                    <span class="block text-4xl font-bold text-primary mb-2">0</span>
                    <span class="block text-sm font-bold text-slate-900 mb-2">Program Kerja Selesai</span>
                    <p class="text-xs text-slate-400 leading-relaxed">Berbagai kegiatan akademik dan non-akademik</p>
                </div>
                <!-- Stat 2 -->
                <div class="bg-white rounded-xl p-8 border border-slate-100 shadow-sm text-center card-hover">
                    <span class="block text-4xl font-bold text-primary mb-2">0+</span>
                    <span class="block text-sm font-bold text-slate-900 mb-2">Mahasiswa Terlibat</span>
                    <p class="text-xs text-slate-400 leading-relaxed">Partisipasi aktif dari seluruh angkatan</p>
                </div>
                <!-- Stat 3 -->
                <div class="bg-white rounded-xl p-8 border border-slate-100 shadow-sm text-center card-hover">
                    <span class="block text-4xl font-bold text-primary mb-2">3</span>
                    <span class="block text-sm font-bold text-slate-900 mb-2">Mitra Kerjasama</span>
                    <p class="text-xs text-slate-400 leading-relaxed">Kolaborasi dengan industri dan institusi</p>
                </div>
                <!-- Stat 4 -->
                <div class="bg-white rounded-xl p-8 border border-slate-100 shadow-sm text-center card-hover">
                    <span class="block text-4xl font-bold text-primary mb-2">0</span>
                    <span class="block text-sm font-bold text-slate-900 mb-2">Bulan Aktif</span>
                    <p class="text-xs text-slate-400 leading-relaxed">Konsistensi kegiatan sepanjang tahun</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Completed Programs Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Program Kerja yang Telah Selesai</h2>
            <p class="text-slate-500 max-w-xl mx-auto mb-16">
                Berikut adalah dokumentasi lengkap kegiatan dan program kerja yang telah berhasil dilaksanakan
            </p>

            <!-- Use a min-height for empty state -->
            <div class="min-h-[200px] flex flex-col items-center justify-center py-12">
                <p class="text-slate-500 mb-8">Ingin melihat Program kerja lainnya atau melihat pengumuman mendatang?</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ url('/program-kerja') }}"
                        class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary-hover transition-colors shadow-lg shadow-primary/20">
                        Lihat Program Kerja
                    </a>
                    <a href="{{ url('/pengumuman') }}"
                        class="px-6 py-3 bg-slate-50 text-slate-700 font-bold rounded-lg border border-slate-200 hover:bg-slate-100 transition-colors">
                        Lihat Pengumuman
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
    </style>
@endsection
