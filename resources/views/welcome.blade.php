@extends('layouts.app')

@section('content')
    {{-- Hero Bento --}}
    <section class="max-w-screen-2xl mx-auto px-6 md:px-6 pt-10 md:pt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Left: Headline + CTA --}}
            <div class="flex flex-col justify-center gap-5">
                <span
                    class="inline-flex w-fit items-center gap-2 rounded-full border border-slate-200 px-3 py-1 text-xs text-slate-500">
                    <i class="h-1.5 w-1.5 rounded-full bg-amber-500" aria-hidden="true"></i>
                    Informatika • Kolaboratif • Progresif
                </span>
                <h1 class="text-balance text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight text-slate-900">
                    Himpunan Mahasiswa Informatika
                    <span class="block text-slate-600">
                        Tempat bertumbuh, berjejaring, dan berkarya.
                    </span>
                </h1>
                <p class="text-pretty text-slate-500 max-w-prose">
                    Kami memfasilitasi pengembangan diri lewat divisi, program kerja,
                    dan kegiatan berdampak. Ikut terlibat dan jadilah bagian dari
                    perubahan.
                </p>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="/program"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-white hover:bg-primary/90 h-10 px-4 py-2">
                        Lihat Program Kerja
                    </a>
                    <a href="/kegiatan"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-amber-100 text-amber-900 hover:bg-amber-200 h-10 px-4 py-2 border border-amber-200">
                        Jelajahi Kegiatan
                    </a>
                </div>
            </div>

            {{-- Right: Bento cards --}}
            <div class="grid grid-cols-2 gap-4">
                {{-- Stats Card --}}
                <div class="col-span-2 md:col-span-2 rounded-lg border-2 border-slate-200 p-4 bg-white/50">
                    <h3 class="text-sm text-slate-500 mb-3">Sekilas Angka</h3>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="rounded-lg border border-slate-200 p-3 bg-white">
                            <div class="text-xl font-semibold text-slate-900">{{ $stats['programs'] }}+</div>
                            <div class="text-xs text-slate-500">Program</div>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-3 bg-white">
                            <div class="text-xl font-semibold text-slate-900">{{ $stats['divisions'] }}</div>
                            <div class="text-xs text-slate-500">Divisi</div>
                        </div>
                        <div class="rounded-lg border border-slate-200 p-3 bg-white">
                            <div class="text-xl font-semibold text-slate-900">{{ $stats['members'] }}+</div>
                            <div class="text-xs text-slate-500">Anggota</div>
                        </div>
                    </div>
                </div>

                {{-- Event Card --}}
                <div class="rounded-lg border border-slate-200 p-4 bg-white hover:shadow-md transition-shadow">
                    <h3 class="text-sm text-slate-500">Kegiatan Terdekat</h3>
                    @if ($upcomingActivity)
                        <p class="mt-1 font-medium text-slate-900 line-clamp-1" title="{{ $upcomingActivity->name }}">
                            {{ $upcomingActivity->name }}</p>
                        <p class="text-sm text-slate-500">
                            {{ \Carbon\Carbon::parse($upcomingActivity->start_date)->translatedFormat('l, d M Y') }}
                        </p>
                        <a href="/kegiatan/{{ $upcomingActivity->slug }}"
                            class="mt-3 inline-flex items-center gap-2 text-sm text-amber-600 hover:underline">
                            Detail kegiatan
                            <svg width="16" height="16" viewBox="0 0 24 24" class="fill-none stroke-current">
                                <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <p class="mt-1 font-medium text-slate-900">Belum ada kegiatan</p>
                        <p class="text-sm text-slate-500">Nantikan informasi selanjutnya</p>
                    @endif
                </div>

                {{-- Announcement Card --}}
                <div class="rounded-lg border border-slate-200 p-4 bg-white hover:shadow-md transition-shadow">
                    <h3 class="text-sm text-slate-500">Pengumuman Terbaru</h3>
                    @if ($latestAnnouncement)
                        <p class="mt-1 font-medium text-slate-900 line-clamp-1" title="{{ $latestAnnouncement->title }}">
                            {{ $latestAnnouncement->title }}</p>
                        <p class="text-sm text-slate-500">
                            {{ $latestAnnouncement->published_at ? $latestAnnouncement->published_at->diffForHumans() : 'Baru saja' }}
                        </p>
                        <a href="/pengumuman/{{ $latestAnnouncement->slug }}"
                            class="mt-3 inline-flex items-center gap-2 text-sm text-amber-600 hover:underline">
                            Lihat pengumuman
                            <svg width="16" height="16" viewBox="0 0 24 24" class="fill-none stroke-current">
                                <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <p class="mt-1 font-medium text-slate-900">Belum ada pengumuman</p>
                        <p class="text-sm text-slate-500">Cek kembali nanti</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Hero visual --}}
        <div class="mt-8 rounded-xl border border-slate-200 p-3 md:p-4 bg-white">
            <div class="relative w-full overflow-hidden rounded-lg border border-slate-100">
                <img src="{{ asset('image/wisuda72.png') }}" alt="Mahasiswa informatika berkolaborasi di laboratorium"
                    width="1280" height="480" class="h-56 sm:h-72 md:h-80 w-full object-cover">
                <div class="absolute left-0 top-0 h-1 w-28 bg-amber-500" aria-hidden="true"></div>
                <div class="absolute right-0 bottom-0 h-1 w-16 bg-primary" aria-hidden="true"></div>
            </div>
        </div>
    </section>

    {{-- Quick Links --}}
    <section class="max-w-screen-2xl mx-auto px-6 md:px-6 mt-10 md:mt-14">
        <h2 class="text-balance text-2xl md:text-3xl font-semibold text-slate-900">Jelajahi HMIF</h2>
        <p class="text-slate-500 mt-2 max-w-prose">Akses cepat ke halaman yang paling sering dicari.</p>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @php
                $links = [
                    [
                        'href' => '/struktur-organisasi',
                        'title' => 'Struktur Organisasi',
                        'desc' => 'Kenali kepengurusan dan perannya.',
                    ],

                    [
                        'href' => '/program-kerja',
                        'title' => 'Program Kerja',
                        'desc' => 'Inisiatif strategis sepanjang periode.',
                    ],
                    ['href' => '/kegiatan', 'title' => 'Kegiatan', 'desc' => 'Agenda rutin dan event khusus.'],
                    [
                        'href' => '/pengumuman',
                        'title' => 'Pengumuman/Berita',
                        'desc' => 'Informasi terbaru seputar HMIF.',
                    ],
                ];
            @endphp

            @foreach ($links as $l)
                <a href="{{ $l['href'] }}"
                    class="group relative rounded-lg border border-slate-200 p-4 transition-colors hover:bg-slate-50 bg-white">
                    <span class="absolute left-0 top-0 h-full w-1 bg-primary rounded-l-lg" aria-hidden="true"></span>
                    <div class="pr-4">
                        <h3 class="font-medium text-slate-900 group-hover:text-primary transition-colors">
                            {{ $l['title'] }}</h3>
                        <p class="text-sm text-slate-500 mt-1">{{ $l['desc'] }}</p>
                        <span class="mt-3 inline-flex items-center gap-2 text-sm text-primary">
                            Buka halaman
                            <svg width="16" height="16" viewBox="0 0 24 24" class="fill-none stroke-current">
                                <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Highlights Bento --}}
    <section class="mx-auto max-w-7xl px-4 md:px-6 mt-12 md:mt-16 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            {{-- Card 1 --}}
            <div
                class="relative rounded-xl border border-slate-200 bg-white p-5 transition hover:shadow-md hover:border-slate-300">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-2.5 py-1 text-xs text-slate-500">
                    <i class="h-1.5 w-1.5 rounded-full bg-primary" aria-hidden="true"></i> Program
                </span>
                <h3 class="mt-3 text-lg font-semibold text-slate-900">Program Unggulan</h3>
                <p class="mt-2 text-sm text-slate-500">Rangkaian program prioritas untuk mengakselerasi kapasitas
                    anggota.</p>
                <a href="/program-kerja" class="mt-4 inline-flex items-center gap-2 text-sm text-primary hover:underline">
                    Lihat program
                    <svg width="16" height="16" viewBox="0 0 24 24" class="fill-none stroke-current">
                        <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            {{-- Card 2 --}}
            <div
                class="relative rounded-xl border border-slate-200 bg-white p-5 transition hover:shadow-md hover:border-slate-300">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-2.5 py-1 text-xs text-slate-500">
                    <i class="h-1.5 w-1.5 rounded-full bg-primary" aria-hidden="true"></i> Kegiatan
                </span>
                <h3 class="mt-3 text-lg font-semibold text-slate-900">Kegiatan Terbaru</h3>
                <p class="mt-2 text-sm text-slate-500">Dokumentasi kegiatan terkini dan agenda yang sedang berjalan.
                </p>
                <a href="/kegiatan" class="mt-4 inline-flex items-center gap-2 text-sm text-primary hover:underline">
                    Jelajahi kegiatan
                    <svg width="16" height="16" viewBox="0 0 24 24" class="fill-none stroke-current">
                        <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            {{-- Card 3 --}}
            <div
                class="relative rounded-xl border border-slate-200 bg-white p-5 transition hover:shadow-md hover:border-slate-300">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-2.5 py-1 text-xs text-slate-500">
                    <i class="h-1.5 w-1.5 rounded-full bg-primary" aria-hidden="true"></i> Info
                </span>
                <h3 class="mt-3 text-lg font-semibold text-slate-900">Pengumuman & Berita</h3>
                <p class="mt-2 text-sm text-slate-500">Informasi penting, rilis resmi, dan liputan HMIF.</p>
                <a href="/pengumuman" class="mt-4 inline-flex items-center gap-2 text-sm text-primary hover:underline">
                    Baca kabar terbaru
                    <svg width="16" height="16" viewBox="0 0 24 24" class="fill-none stroke-current">
                        <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
