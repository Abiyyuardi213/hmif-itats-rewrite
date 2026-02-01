@extends('layouts.app')

@section('title', 'Struktur Organisasi - HMIF ITATS')

@section('content')
    <section class="py-20 lg:py-32 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Main Heading -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-2">
                Struktur organisasi
            </h1>
            <h2 class="text-3xl md:text-5xl lg:text-5xl font-bold text-slate-500 mb-8">
                Himpunan Mahasiswa Informatika
            </h2>

            <!-- Subheading -->
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Mengenal lebih dekat dengan para pengurus yang berdedikasi untuk kemajuan organisasi mahasiswa
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20 bg-white min-h-[400px] flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-400">
            <p class="text-lg">Belum ada anggota yang terdaftar dalam struktur organisasi</p>
        </div>
    </section>

    <!-- Join Section -->
    <section class="py-20 bg-slate-50 border-t border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Bergabung dengan Kami</h2>
            <p class="text-slate-500 mb-6">
                Tertarik untuk berkontribusi? Hubungi kami untuk informasi lebih lanjut tentang cara bergabung
            </p>
            <div class="flex flex-col md:flex-row justify-center items-center gap-4 text-sm text-slate-500">
                <span>Email: organisasi@mahasiswa.ac.id</span>
                <span class="hidden md:inline">•</span>
                <span>Instagram: @organisasimahasiswa</span>
            </div>
        </div>
    </section>
@endsection
