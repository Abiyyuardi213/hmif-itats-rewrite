@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-background py-8 px-6">
        <div class="max-w-7xl mx-auto space-y-6">
            {{-- Back Button --}}
            <a href="/pengumuman"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/10 hover:text-primary h-10 px-4 py-2 bg-transparent text-foreground mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
                Kembali ke Daftar Pengumuman
            </a>

            @if (!isset($announcement))
                <div class="p-8 border rounded-lg bg-card text-center">
                    <h2 class="text-xl font-bold">Data tidak ditemukan</h2>
                    <p class="text-muted-foreground">Pastikan route mengirimkan variable <code>$announcement</code>.</p>
                </div>
            @else
                @php
                    $pubDate = $announcement->published_at ?? $announcement->created_at;
                @endphp

                {{-- 2-Column Grid Layout --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    
                    {{-- Left Column: Main Detail Content (2 Cols on lg) --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div
                            class="overflow-hidden rounded-xl border border-border/50 bg-card/80 backdrop-blur-sm text-card-foreground shadow-sm">
                            <div class="p-6 md:p-8 space-y-6">
                                {{-- Header --}}
                                <div class="space-y-4">
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold bg-purple-100 text-purple-700 border-purple-200 uppercase">
                                            Pengumuman
                                        </span>
                                    </div>

                                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-foreground text-balance">
                                        {{ $announcement->title }}
                                    </h1>

                                    <div class="flex flex-wrap items-center gap-4 text-sm text-muted-foreground pt-1 pb-2 border-y border-border/40">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                                <line x1="16" x2="16" y1="2" y2="6" />
                                                <line x1="8" x2="8" y1="2" y2="6" />
                                                <line x1="3" x2="21" y1="10" y2="10" />
                                            </svg>
                                            <span>{{ $pubDate->translatedFormat('d F Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                            <span>Admin HMIF</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Main Banner Image --}}
                                @if ($announcement->image)
                                    <div class="rounded-lg overflow-hidden border border-border/50 max-h-[420px]">
                                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif

                                {{-- Content HTML --}}
                                <div
                                    class="prose prose-slate max-w-none prose-headings:text-foreground prose-p:text-slate-700 prose-li:text-slate-700 prose-strong:text-foreground prose-headings:font-bold prose-h2:text-2xl prose-h3:text-xl prose-p:leading-relaxed pt-2">
                                    {!! $announcement->content !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Sidebar Rekap Pengumuman Lainnya (1 Col on lg) --}}
                    <div class="space-y-6">
                        <div class="rounded-xl border border-border/50 bg-card/80 backdrop-blur-sm p-6 shadow-sm sticky top-24">
                            <h3 class="text-lg font-bold text-slate-900 mb-4 pb-3 border-b border-slate-200 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                Rekap Pengumuman Lainnya
                            </h3>

                            <div class="space-y-4 divide-y divide-slate-100">
                                @forelse($recentAnnouncements as $item)
                                    @php
                                        $itemDate = $item->published_at ?? $item->created_at;
                                    @endphp
                                    <a href="{{ route('pengumuman.show', $item->slug) }}" class="block pt-3 first:pt-0 group">
                                        <div class="flex gap-3">
                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                                    class="w-16 h-16 rounded-md object-cover flex-shrink-0 group-hover:opacity-90 transition-opacity">
                                            @else
                                                <div class="w-16 h-16 rounded-md bg-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="space-y-1 flex-1">
                                                <h4 class="text-sm font-semibold text-slate-800 group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                                    {{ $item->title }}
                                                </h4>
                                                <p class="text-[11px] text-slate-400 font-medium">
                                                    {{ $itemDate->translatedFormat('d M Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-xs text-slate-400 italic">Belum ada pengumuman lainnya.</p>
                                @endforelse
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-100">
                                <a href="/pengumuman" class="block w-full text-center text-xs font-semibold text-primary hover:text-primary/80 transition-colors py-2 bg-primary/5 rounded-md">
                                    Lihat Semua Pengumuman →
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
@endsection
