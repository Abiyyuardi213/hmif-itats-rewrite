@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-background pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
            {{-- Back Button --}}
            <div class="mb-8">
                <a href="{{ route('kegiatan.index') }}"
                    class="inline-flex items-center text-sm font-medium text-muted-foreground hover:text-primary transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="mr-2 w-4 h-4 group-hover:-translate-x-1 transition-transform">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                    Kembali ke Daftar Kegiatan
                </a>
            </div>

            {{-- Header Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                {{-- Left: Text Info --}}
                <div class="space-y-6">
                    <div class="space-y-4">
                        <div class="flex flex-wrap items-center gap-2">
                            @if ($program->category)
                                <span
                                    class="inline-flex items-center rounded-full border border-primary/20 bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">
                                    {{ $program->category }}
                                </span>
                            @endif
                            <span class="inline-flex items-center text-sm text-muted-foreground">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1 w-4 h-4">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                    <line x1="16" x2="16" y1="2" y2="6" />
                                    <line x1="8" x2="8" y1="2" y2="6" />
                                    <line x1="3" x2="21" y1="10" y2="10" />
                                </svg>
                                {{ \Carbon\Carbon::parse($program->start_date)->translatedFormat('d F Y') }}
                            </span>
                        </div>

                        <h1 class="text-4xl font-extrabold text-foreground tracking-tight lg:text-5xl">
                            {{ $program->name }}
                        </h1>
                    </div>

                    <div class="prose prose-slate dark:prose-invert max-w-none text-muted-foreground leading-relaxed">
                        <p>{{ $program->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <div class="p-4 rounded-lg bg-secondary/50 border border-border">
                            <div class="text-sm text-muted-foreground mb-1">Peserta</div>
                            <div class="text-2xl font-bold text-foreground">{{ $program->participants_count ?? 0 }}</div>
                        </div>
                        <div class="p-4 rounded-lg bg-secondary/50 border border-border">
                            <div class="text-sm text-muted-foreground mb-1">Lokasi</div>
                            <div class="text-lg font-bold text-foreground line-clamp-1">{{ $program->location ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Main Image --}}
                <div class="relative group rounded-2xl overflow-hidden bg-muted aspect-video lg:aspect-square shadow-xl">
                    @if ($program->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $program->images->first()->image_path) }}"
                            alt="{{ $program->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div
                            class="w-full h-full flex flex-col items-center justify-center text-muted-foreground bg-secondary/30">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="mb-2 opacity-50">
                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                <circle cx="9" cy="9" r="2" />
                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                            </svg>
                            <span class="text-sm">Tidak ada dokumentasi utama</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Documentation Gallery --}}
            @if ($program->images->count() > 1)
                <div class="mb-16">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-6 h-6 text-primary">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                            <circle cx="9" cy="9" r="2" />
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                        </svg>
                        Galeri Dokumentasi
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($program->images->skip(1) as $image)
                            <div class="relative group rounded-xl overflow-hidden aspect-square bg-muted cursor-pointer hover:shadow-lg transition-all"
                                onclick="window.open('{{ asset('storage/' . $image->image_path) }}', '_blank')">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Team Section --}}
            @if ($program->teams->isNotEmpty() || $program->head)
                <div class="mb-16">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-6 h-6 text-primary">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Tim Pelaksana
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if ($program->head)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-card border border-border shadow-sm">
                                <div class="relative h-12 w-12 flex-shrink-0 overflow-hidden rounded-full bg-secondary">
                                    @if ($program->head->image)
                                        <img class="h-full w-full object-cover"
                                            src="{{ asset('storage/' . $program->head->image) }}"
                                            alt="{{ $program->head->name }}">
                                    @else
                                        <div
                                            class="h-full w-full flex items-center justify-center text-muted-foreground font-bold">
                                            {{ substr($program->head->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-medium text-foreground">{{ $program->head->name }}</div>
                                    <div class="text-xs text-primary font-semibold uppercase tracking-wide">Ketua Pelaksana
                                    </div>
                                </div>
                            </div>
                        @endif

                        @foreach ($program->teams as $team)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-card border border-border bg-muted/20">
                                <div class="relative h-12 w-12 flex-shrink-0 overflow-hidden rounded-full bg-secondary">
                                    @if ($team->member->image)
                                        <img class="h-full w-full object-cover"
                                            src="{{ asset('storage/' . $team->member->image) }}"
                                            alt="{{ $team->member->name }}">
                                    @else
                                        <div
                                            class="h-full w-full flex items-center justify-center text-muted-foreground font-bold">
                                            {{ substr($team->member->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-medium text-foreground">{{ $team->member->name }}</div>
                                    <div class="text-xs text-muted-foreground">
                                        {{ $team->member->position ? $team->member->position->name : $team->role ?? 'Anggota' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
