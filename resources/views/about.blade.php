@extends('layouts.app')

@section('title', 'Tentang HMIF ITATS')

@section('content')
    <div class="bg-white min-h-screen">
        {{-- Hero Section --}}
        {{-- Hero Section (Matched to Welcome.blade.php Style) --}}
        <section class="max-w-screen-2xl mx-auto px-6 md:px-6 pt-10 md:pt-16 border-b border-slate-200 pb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                {{-- Left: Headline --}}
                <div class="flex flex-col justify-center gap-5">
                    <span
                        class="inline-flex w-fit items-center gap-2 rounded-full border border-slate-200 px-3 py-1 text-xs text-slate-500">
                        <i class="h-1.5 w-1.5 rounded-full bg-primary" aria-hidden="true"></i>
                        Profil Himpunan
                    </span>
                    <h1 class="text-balance text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight text-slate-900">
                        Mengenal Lebih Dekat
                        <span class="block text-slate-600">
                            HMIF ITATS
                        </span>
                    </h1>
                    <p class="text-pretty text-slate-500 max-w-prose">
                        Wadah aspirasi, kreasi, dan inovasi bagi seluruh mahasiswa Teknik Informatika ITATS. Bersatu untuk
                        memajukan teknologi dan organisasi.
                    </p>
                </div>

                {{-- Right: Visual/Card --}}
                <div class="relative w-full overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-1">
                    <div class="relative w-full h-64 md:h-80 rounded-lg overflow-hidden">
                        {{-- Random placeholder or specific image if available --}}
                        <img src="{{ asset('image/wisuda72.png') }}" alt="HMIF Team"
                            class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-tr from-slate-900/40 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-bold text-lg">Bersama Kita Bisa</p>
                            <p class="text-xs text-slate-200">Kabinet Period 2024/2025</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content Sections --}}
        <div class="container mx-auto px-6 py-16 space-y-24">
            <style>
                .visi-misi-styled h3 {
                    font-size: 1.5rem;
                    font-weight: 700;
                    color: #0f172a;
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                }
                .visi-misi-styled h3:first-child {
                    margin-top: 0;
                }
                .visi-misi-styled p {
                    color: #475569;
                    font-size: 1.125rem;
                    line-height: 1.75;
                    border-left: 4px solid rgba(15, 23, 42, 0.2);
                    padding-left: 1.25rem;
                    padding-top: 0.5rem;
                    padding-bottom: 0.5rem;
                    background-color: rgba(248, 250, 252, 0.8);
                    border-top-right-radius: 0.75rem;
                    border-bottom-right-radius: 0.75rem;
                    font-style: italic;
                    margin-bottom: 1.5rem;
                }
                .visi-misi-styled ol {
                    list-style: none;
                    counter-reset: visi-misi-counter;
                    padding: 0;
                    margin: 0;
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }
                .visi-misi-styled ol li {
                    counter-increment: visi-misi-counter;
                    position: relative;
                    padding: 1rem 1.25rem 1rem 3.5rem;
                    color: #475569;
                    font-size: 0.95rem;
                    line-height: 1.6;
                    background: #ffffff;
                    border-radius: 1rem;
                    border: 1px solid #f1f5f9;
                    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.02);
                    transition: all 0.2s ease;
                }
                .visi-misi-styled ol li:hover {
                    border-color: #cbd5e1;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                }
                .visi-misi-styled ol li::before {
                    content: counter(visi-misi-counter);
                    position: absolute;
                    left: 1rem;
                    top: 1rem;
                    width: 1.75rem;
                    height: 1.75rem;
                    background-color: #0f172a;
                    color: #ffffff;
                    font-size: 0.75rem;
                    font-weight: 700;
                    border-radius: 9999px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .visi-misi-styled ul {
                    list-style: disc;
                    padding-left: 1.5rem;
                    color: #475569;
                    margin-bottom: 1.5rem;
                }
            </style>

            {{-- Study Program Vision & Mission Section (Dynamic from Admin) --}}
            @if ($visiMisi && $visiMisi->is_active)
            <section class="relative overflow-hidden rounded-3xl bg-slate-50 border border-slate-200 p-8 md:p-12 shadow-sm">
                {{-- Decorative elements --}}
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>

                <div class="relative z-10 max-w-6xl mx-auto">
                    @if ($visiMisi->images->count() > 0 || $visiMisi->image)
                        {{-- Data 1: Side-by-Side (Media LEFT, Content RIGHT) --}}
                        <div class="flex flex-col lg:flex-row gap-12 items-center">
                            {{-- Media / Image Side (Left) --}}
                            <div class="w-full lg:w-1/2">
                                @if ($visiMisi->images->count() > 1)
                                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] group border border-slate-200" x-data="{ activeSlide: 0, slides: {{ $visiMisi->images->count() }} }">
                                        <div class="relative w-full h-full">
                                            @foreach ($visiMisi->images as $key => $img)
                                                <div x-show="activeSlide === {{ $key }}"
                                                    x-transition:enter="transition ease-out duration-500"
                                                    x-transition:enter-start="opacity-0 transform scale-95"
                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                    x-transition:leave="transition ease-in duration-300"
                                                    x-transition:leave-start="opacity-100 transform scale-100"
                                                    x-transition:leave-end="opacity-0 transform scale-95"
                                                    class="absolute inset-0 w-full h-full">
                                                    <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $visiMisi->title }}"
                                                        class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
                                            class="absolute left-3 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white transition-all opacity-0 group-hover:opacity-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                        </button>
                                        <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white transition-all opacity-0 group-hover:opacity-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>
                                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
                                            @foreach ($visiMisi->images as $key => $img)
                                                <button @click="activeSlide = {{ $key }}"
                                                    class="w-2 h-2 rounded-full transition-all"
                                                    :class="activeSlide === {{ $key }} ? 'bg-white w-5' : 'bg-white/50 hover:bg-white/80'">
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] w-full border border-slate-200">
                                        <img src="{{ asset('storage/' . ($visiMisi->images->first()->image ?? $visiMisi->image)) }}" alt="{{ $visiMisi->title }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>

                            {{-- Content Side (Right) --}}
                            <div class="w-full lg:w-1/2 space-y-6">
                                <div class="space-y-3">
                                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-900/5 border border-slate-200 px-4 py-1.5 text-sm font-semibold text-slate-700">
                                        {{ $visiMisi->subtitle ?: 'Akademik' }}
                                    </span>
                                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight">{{ $visiMisi->title }}</h2>
                                    <p class="text-slate-500 text-sm">Teknik Informatika - Institut Teknologi Adhi Tama Surabaya</p>
                                </div>
                                <div class="visi-misi-styled">
                                    {!! $visiMisi->content !!}
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Fallback: Full Width Single Column when No Image --}}
                        <div class="text-center mb-12 space-y-4">
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-900/5 border border-slate-200 px-4 py-1.5 text-sm font-semibold text-slate-700">
                                {{ $visiMisi->subtitle ?: 'Akademik' }}
                            </span>
                            <h2 class="text-3xl md:text-5xl font-bold text-slate-900 tracking-tight">{{ $visiMisi->title }}</h2>
                            <p class="text-slate-500 text-lg">Teknik Informatika - Institut Teknologi Adhi Tama Surabaya</p>
                        </div>
                        <div class="visi-misi-styled">
                            {!! $visiMisi->content !!}
                        </div>
                    @endif
                </div>
            </section>
            @endif

            {{-- Kabinet REBOOT Vision & Mission Section (Dynamic from Admin) --}}
            @if ($visiMisiKabinet && $visiMisiKabinet->is_active)
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 to-slate-950 text-white p-8 md:p-12 shadow-xl border border-slate-800">
                {{-- Decorative elements --}}
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 max-w-6xl mx-auto">
                    @if ($visiMisiKabinet->images->count() > 0 || $visiMisiKabinet->image)
                        {{-- Data 2: Zig-Zag Side-by-Side (Media RIGHT, Content LEFT) --}}
                        <div class="flex flex-col lg:flex-row-reverse gap-12 items-center">
                            {{-- Media / Image Side (Right) --}}
                            <div class="w-full lg:w-1/2">
                                @if ($visiMisiKabinet->images->count() > 1)
                                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] group border border-slate-800" x-data="{ activeSlide: 0, slides: {{ $visiMisiKabinet->images->count() }} }">
                                        <div class="relative w-full h-full">
                                            @foreach ($visiMisiKabinet->images as $key => $img)
                                                <div x-show="activeSlide === {{ $key }}"
                                                    x-transition:enter="transition ease-out duration-500"
                                                    x-transition:enter-start="opacity-0 transform scale-95"
                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                    x-transition:leave="transition ease-in duration-300"
                                                    x-transition:leave-start="opacity-100 transform scale-100"
                                                    x-transition:leave-end="opacity-0 transform scale-95"
                                                    class="absolute inset-0 w-full h-full">
                                                    <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $visiMisiKabinet->title }}"
                                                        class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
                                            class="absolute left-3 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white transition-all opacity-0 group-hover:opacity-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                        </button>
                                        <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white transition-all opacity-0 group-hover:opacity-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>
                                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
                                            @foreach ($visiMisiKabinet->images as $key => $img)
                                                <button @click="activeSlide = {{ $key }}"
                                                    class="w-2 h-2 rounded-full transition-all"
                                                    :class="activeSlide === {{ $key }} ? 'bg-white w-5' : 'bg-white/50 hover:bg-white/80'">
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] w-full border border-slate-800">
                                        <img src="{{ asset('storage/' . ($visiMisiKabinet->images->first()->image ?? $visiMisiKabinet->image)) }}" alt="{{ $visiMisiKabinet->title }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>

                            {{-- Content Side (Left) --}}
                            <div class="w-full lg:w-1/2 space-y-6">
                                <div class="space-y-3">
                                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/20 px-4 py-1.5 text-sm font-semibold text-white">
                                        {{ $visiMisiKabinet->subtitle ?: 'HMIF 2024/2025' }}
                                    </span>
                                    <h2 class="text-3xl lg:text-4xl font-bold text-white tracking-tight">{{ $visiMisiKabinet->title }}</h2>
                                    <p class="text-slate-400 text-sm">Himpunan Mahasiswa Teknik Informatika ITATS</p>
                                </div>
                                <div class="visi-misi-styled [&_h3]:text-white [&_p]:bg-white/5 [&_p]:text-slate-200 [&_p]:border-blue-400 [&_ol_li]:bg-slate-900/80 [&_ol_li]:border-slate-800 [&_ol_li]:text-slate-300 [&_ol_li::before]:bg-white [&_ol_li::before]:text-slate-950">
                                    {!! $visiMisiKabinet->content !!}
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Fallback: Full Width Single Column when No Image --}}
                        <div class="text-center mb-12 space-y-4">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/20 px-4 py-1.5 text-sm font-semibold text-white">
                                {{ $visiMisiKabinet->subtitle ?: 'HMIF 2024/2025' }}
                            </span>
                            <h2 class="text-3xl md:text-5xl font-bold text-white tracking-tight">{{ $visiMisiKabinet->title }}</h2>
                            <p class="text-slate-400 text-lg">Himpunan Mahasiswa Teknik Informatika ITATS</p>
                        </div>
                        <div class="visi-misi-styled [&_h3]:text-white [&_p]:bg-white/5 [&_p]:text-slate-200 [&_p]:border-blue-400 [&_ol_li]:bg-slate-900/80 [&_ol_li]:border-slate-800 [&_ol_li]:text-slate-300 [&_ol_li::before]:bg-white [&_ol_li::before]:text-slate-950">
                            {!! $visiMisiKabinet->content !!}
                        </div>
                    @endif
                </div>
            </section>
            @endif

            @forelse($pages as $index => $page)
                <div
                    class="flex flex-col lg:flex-row gap-12 items-center {{ $index % 2 != 0 ? 'lg:flex-row-reverse' : '' }}">
                    @if ($page->images->count() > 1)
                        {{-- Carousel --}}
                        <div class="w-full lg:w-1/2" x-data="{ activeSlide: 0, slides: {{ $page->images->count() }} }">
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] group">
                                {{-- Slides --}}
                                <div class="relative w-full h-full">
                                    @foreach ($page->images as $key => $img)
                                        <div x-show="activeSlide === {{ $key }}"
                                            x-transition:enter="transition ease-out duration-500"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            class="absolute inset-0 w-full h-full">
                                            <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $page->title }}"
                                                class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Controls --}}
                                <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white transition-all opacity-0 group-hover:opacity-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white transition-all opacity-0 group-hover:opacity-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>

                                {{-- Indicators --}}
                                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                                    @foreach ($page->images as $key => $img)
                                        <button @click="activeSlide = {{ $key }}"
                                            class="w-2 h-2 rounded-full transition-all"
                                            :class="activeSlide === {{ $key }} ? 'bg-white w-6' :
                                                'bg-white/50 hover:bg-white/80'">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @elseif ($page->images->count() == 1 || $page->image)
                        {{-- Single Image (No Tilt) --}}
                        <div class="w-full lg:w-1/2">
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl w-full aspect-[4/3]">
                                <img src="{{ asset('storage/' . ($page->images->first()->image ?? $page->image)) }}"
                                    alt="{{ $page->title }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @else
                        {{-- Fallback illustration if no image --}}
                        <div
                            class="w-full lg:w-1/2 flex items-center justify-center p-12 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                            <div class="text-center text-slate-400">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium">No Image Provided</span>
                            </div>
                        </div>
                    @endif

                    <div class="w-full lg:w-1/2 space-y-6">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span
                                    class="text-5xl font-black text-slate-100 absolute -z-10 select-none transform -translate-y-8 -translate-x-6 scale-150">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h2 class="text-3xl font-bold text-slate-900 relative pl-4 border-l-4 border-primary/80">
                                    {{ $page->title }}
                                </h2>
                            </div>
                        </div>

                        <div
                            class="prose prose-lg prose-slate text-slate-600 prose-headings:text-slate-900 prose-a:text-primary hover:prose-a:text-primary/80">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                        <i class="fas fa-info text-slate-400 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Belum ada informasi</h3>
                    <p class="text-slate-500 mt-2">Halaman profil himpunan sedang diperbarui.</p>
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center mt-6 text-primary font-semibold hover:underline">
                        &larr; Kembali ke Beranda
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Contact CTA --}}
        <section class="py-20 bg-slate-900 text-white overflow-hidden relative">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl"></div>

            <div class="container mx-auto px-6 relative z-10 text-center space-y-8">
                <h2 class="text-3xl md:text-4xl font-bold">Punya Pertanyaan Lain?</h2>
                <p class="text-slate-300 max-w-xl mx-auto text-lg">
                    Jangan ragu untuk menghubungi kami melalui media sosial atau datang langsung ke sekretariat.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="https://instagram.com/hmif_itats" target="_blank"
                        class="px-8 py-3 rounded-full bg-white text-slate-900 font-bold hover:bg-slate-100 transition-colors shadow-lg flex items-center gap-2">
                        <i class="fab fa-instagram text-xl"></i>
                        Instagram HMIF
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
