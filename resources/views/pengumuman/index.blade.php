@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8 space-y-8 min-h-screen bg-background">

        {{-- Announcements Grid --}}
        <div class="grid gap-6 md:gap-8">
            @forelse($announcements as $post)
                @php
                    $pubDate = $post->published_at ?? $post->created_at;
                @endphp
                <a href="{{ route('pengumuman.show', $post->slug) }}">
                    <div
                        class="group relative overflow-hidden rounded-xl border border-border/50 bg-card/80 backdrop-blur-sm hover:bg-card transition-all duration-300 hover:shadow-xl hover:shadow-primary/20 cursor-pointer">
                        <div class="md:flex">
                            {{-- Image Section --}}
                            <div class="md:w-1/3 lg:w-1/4">
                                <div class="relative h-48 md:h-full overflow-hidden">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full min-h-[180px] bg-slate-100 flex items-center justify-center text-slate-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            </div>

                            {{-- Content Section --}}
                            <div class="md:w-2/3 lg:w-3/4 p-6 md:p-8">
                                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-8">
                                    {{-- Date Box --}}
                                    <div class="flex-shrink-0">
                                        <div class="text-center p-4 bg-muted/50 rounded-lg border border-border/50">
                                            <div class="text-2xl font-bold text-primary">{{ $pubDate->format('d') }}</div>
                                            <div class="text-sm text-muted-foreground">
                                                <span>{{ $pubDate->translatedFormat('M') }}</span>
                                                <span>{{ $pubDate->format('Y') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Details --}}
                                    <div class="flex-1 space-y-4">
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold bg-purple-100 text-purple-700 border-purple-200 uppercase">
                                                Pengumuman
                                            </span>
                                        </div>

                                        <h3
                                            class="text-xl md:text-2xl font-bold text-foreground group-hover:text-primary transition-colors text-balance">
                                            {{ $post->title }}
                                        </h3>

                                        <p class="text-muted-foreground leading-relaxed text-pretty">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}
                                        </p>

                                        <div class="flex items-center justify-between pt-4 border-t border-border/50">
                                            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg>
                                                <span>Admin HMIF</span>
                                            </div>

                                            <span
                                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-9 px-3 group-hover:bg-primary/10 group-hover:text-primary bg-transparent text-primary">
                                                Baca Selengkapnya
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="m12 5 7 7-7 7" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Hover Gradient --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-16 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-slate-500 font-medium">Belum ada pengumuman yang diterbitkan.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="pt-6">
            {{ $announcements->links() }}
        </div>
    </div>
@endsection
