@extends('layouts.app')

@section('title', $report->title)

@section('content')
    <main class="min-h-screen bg-background pt-24 pb-16">
        {{-- Hero / Header --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="max-w-4xl mx-auto text-center mb-8">
                <span
                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-primary/10 text-primary mb-4 uppercase tracking-wider">
                    {{ $report->workProgram->category ?? 'Kegiatan Himpunan' }}
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-foreground mb-6 text-balance">
                    {{ $report->title }}
                </h1>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-muted-foreground">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span>{{ $report->published_at ? $report->published_at->translatedFormat('d F Y') : 'Draft' }}</span>
                    </div>
                    <span class="hidden sm:inline">•</span>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <span>{{ $report->workProgram->division->name ?? 'HMIF ITATS' }}</span>
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="max-w-5xl mx-auto rounded-2xl overflow-hidden shadow-2xl mb-12 aspect-[21/9] relative bg-slate-100">
                @php
                    $imageUrl = $report->image
                        ? asset('storage/' . $report->image)
                        : ($report->workProgram->images->isNotEmpty()
                            ? asset('storage/' . $report->workProgram->images->first()->image_path)
                            : 'https://placehold.co/1200x600?text=HMIF+Activity');
                @endphp
                <img src="{{ $imageUrl }}" alt="{{ $report->title }}" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 max-w-6xl mx-auto">
                {{-- Main Content (Article) --}}
                <div class="lg:col-span-8">
                    <article class="prose prose-lg dark:prose-invert max-w-none text-foreground leading-relaxed">
                        @if ($report->excerpt)
                            <p
                                class="lead text-xl text-muted-foreground mb-8 font-medium italic border-l-4 border-primary pl-4">
                                {{ $report->excerpt }}
                            </p>
                        @endif

                        <div class="space-y-6 trix-content">
                            {!! $report->content !!}
                        </div>
                    </article>

                    {{-- Image Gallery from WorkProgram if available --}}
                    @if ($report->workProgram->images->count() > 0)
                        <div class="mt-16 pt-8 border-t border-border">
                            <h3 class="text-2xl font-bold mb-6">Galeri Dokumentasi</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($report->workProgram->images as $img)
                                    <div
                                        class="rounded-xl overflow-hidden border border-border aspect-square group cursor-pointer relative shadow-sm hover:shadow-md transition-all">
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar (Details) --}}
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-card border border-border rounded-xl p-6 shadow-sm sticky top-24">
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b border-border">Informasi Program</h3>

                        <ul class="space-y-5 text-sm">
                            <li class="flex flex-col gap-1">
                                <span class="text-muted-foreground text-xs uppercase tracking-wider font-semibold">Nama
                                    Program</span>
                                <span class="font-medium text-foreground text-base">{{ $report->workProgram->name }}</span>
                            </li>
                            <li class="flex flex-col gap-1">
                                <span class="text-muted-foreground text-xs uppercase tracking-wider font-semibold">Waktu
                                    Pelaksanaan</span>
                                <span class="font-medium text-foreground">
                                    @if ($report->workProgram->start_date)
                                        {{ \Carbon\Carbon::parse($report->workProgram->start_date)->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </li>
                            <li class="flex flex-col gap-1">
                                <span
                                    class="text-muted-foreground text-xs uppercase tracking-wider font-semibold">Lokasi</span>
                                <span
                                    class="font-medium text-foreground">{{ $report->workProgram->location ?? 'Online / Menyesuaikan' }}</span>
                            </li>
                            <li class="flex flex-col gap-1">
                                <span
                                    class="text-muted-foreground text-xs uppercase tracking-wider font-semibold">Partisipan</span>
                                <span class="font-medium text-foreground flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    {{ $report->workProgram->participants_count ?? 0 }} Peserta
                                </span>
                            </li>
                        </ul>

                        <div class="mt-8 pt-6 border-t border-border">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground mb-4">Ketua
                                Pelaksana</h4>
                            <div class="flex items-center gap-3 bg-muted/50 p-3 rounded-lg">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-sm font-bold text-primary">
                                    {{ substr($report->workProgram->head->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-medium text-foreground text-sm">
                                        {{ $report->workProgram->head->name ?? 'Belum Ditentukan' }}</p>
                                    <p class="text-xs text-muted-foreground">
                                        {{ $report->workProgram->division->name ?? 'Anggota' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('kegiatan.index') }}"
                                class="flex items-center justify-center w-full px-4 py-2 border border-input rounded-md text-sm font-medium hover:bg-accent hover:text-accent-foreground transition-colors gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Lihat Kegiatan Lainnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
