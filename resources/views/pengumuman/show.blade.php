@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-background py-8 px-6">
        <div class="max-w-4xl mx-auto space-y-6">
            {{-- Back Button --}}
            <a href="/pengumuman"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/10 hover:text-primary h-10 px-4 py-2 bg-transparent text-foreground mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
                Kembali ke Daftar
            </a>

            @if (!isset($announcement))
                <div class="p-8 border rounded-lg bg-card text-center">
                    <h2 class="text-xl font-bold">Data tidak ditemukan</h2>
                    <p class="text-muted-foreground">Pastikan route mengirimkan variable <code>$announcement</code>.</p>
                </div>
            @else
                @php
                    // Helper logic for colors (Inline PHP)
                    $priorityColors = [
                        'tinggi' => 'bg-red-500/20 text-red-700 border-red-500/30', // adjusted text color for contrast
                        'sedang' => 'bg-yellow-500/20 text-yellow-700 border-yellow-500/30',
                        'rendah' => 'bg-green-500/20 text-green-700 border-green-500/30',
                    ];
                    $pColor = $priorityColors[$announcement['priority'] ?? ''] ?? 'bg-muted text-muted-foreground';

                    $categoryColors = [
                        'pengumuman' => 'bg-primary/20 text-primary border-primary/30',
                        'berita' => 'bg-blue-500/20 text-blue-700 border-blue-500/30', // adjusted text color
                    ];
                    $cColor = $categoryColors[$announcement['category'] ?? ''] ?? 'bg-gray-100 text-gray-800';
                @endphp

                {{-- Main Content Card --}}
                <div
                    class="overflow-hidden rounded-xl border border-border/50 bg-card/50 backdrop-blur-sm text-card-foreground shadow-sm">
                    <div class="p-6 md:p-8 space-y-6">
                        {{-- Header --}}
                        <div class="space-y-4">
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent {{ $cColor }}">
                                    {{ $announcement['category'] ?? 'General' }}
                                </span>
                                <span
                                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent {{ $pColor }}">
                                    {{ $announcement['priority'] ?? 'Normal' }}
                                </span>
                            </div>

                            <h1 class="text-3xl md:text-4xl font-bold text-foreground text-balance">
                                {{ $announcement['title'] }}</h1>

                            <div class="flex flex-col md:flex-row md:items-center gap-4 text-muted-foreground">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                        <line x1="16" x2="16" y1="2" y2="6" />
                                        <line x1="8" x2="8" y1="2" y2="6" />
                                        <line x1="3" x2="21" y1="10" y2="10" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($announcement['date'])->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    <span>{{ $announcement['author_name'] }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                @if (isset($announcement['tags']) && is_array($announcement['tags']))
                                    @foreach ($announcement['tags'] as $tag)
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground border-border">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z" />
                                                <path d="M7 7h.01" />
                                            </svg>
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-2 pt-4 border-t border-border/50">
                            <button
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="18" cy="5" r="3" />
                                    <circle cx="6" cy="12" r="3" />
                                    <circle cx="18" cy="19" r="3" />
                                    <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
                                    <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
                                </svg>
                                Bagikan
                            </button>
                            <button
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                                </svg>
                                Simpan
                            </button>
                        </div>

                        {{-- Content --}}
                        <div
                            class="prose prose-invert max-w-none prose-headings:text-foreground prose-p:text-muted-foreground prose-li:text-muted-foreground prose-strong:text-foreground prose-headings:font-bold prose-h2:text-2xl prose-h3:text-xl prose-p:leading-relaxed">
                            {!! $announcement['content'] !!}
                        </div>
                    </div>
                </div>

                {{-- Related Actions --}}
                <div class="rounded-xl border border-border/50 bg-card/50 backdrop-blur-sm text-card-foreground shadow-sm">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-foreground">Aksi Terkait</h3>
                        <div class="flex flex-wrap gap-3">
                            <button
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                                Hubungi Penulis
                            </button>
                            <button
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                                Laporkan Masalah
                            </button>
                            <button
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                                Berikan Feedback
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
