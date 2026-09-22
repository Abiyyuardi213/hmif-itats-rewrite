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
                /* Modern Non-Baku Visi & Misi Styling */
                .visi-misi-styled h3 {
                    font-size: 1.1rem;
                    font-weight: 800;
                    letter-spacing: 0.05em;
                    text-transform: uppercase;
                    color: #0f172a;
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    padding: 0.4rem 1rem;
                    background: #f1f5f9;
                    border-radius: 9999px;
                    border: 1px solid #e2e8f0;
                }
                .visi-misi-styled h3:first-child {
                    margin-top: 0;
                }
                .visi-misi-styled p {
                    color: #334155;
                    font-size: 1.05rem;
                    line-height: 1.8;
                    font-weight: 500;
                    padding: 1.25rem 1.5rem;
                    background: #f8fafc;
                    border-left: 4px solid #0f172a;
                    border-radius: 0 1rem 1rem 0;
                    margin-bottom: 2rem;
                }
                .visi-misi-styled ol {
                    list-style: none;
                    counter-reset: visi-counter;
                    padding: 0;
                    margin: 0 0 1.5rem 0;
                    display: flex;
                    flex-direction: column;
                    gap: 0.875rem;
                }
                .visi-misi-styled ol li {
                    counter-increment: visi-counter;
                    position: relative;
                    padding: 0.875rem 1.25rem 0.875rem 3.5rem;
                    color: #334155;
                    font-size: 0.95rem;
                    font-weight: 500;
                    line-height: 1.65;
                    background: #ffffff;
                    border-radius: 0.875rem;
                    border: 1px solid #e2e8f0;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
                    transition: all 0.2s ease;
                }
                .visi-misi-styled ol li:hover {
                    border-color: #94a3b8;
                    transform: translateX(4px);
                }
                .visi-misi-styled ol li::before {
                    content: counter(visi-counter);
                    position: absolute;
                    left: 0.875rem;
                    top: 0.875rem;
                    width: 1.75rem;
                    height: 1.75rem;
                    background: #0f172a;
                    color: #ffffff;
                    font-size: 0.8rem;
                    font-weight: 800;
                    border-radius: 0.5rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .visi-misi-styled ul {
                    list-style: disc;
                    padding-left: 1.5rem;
                    color: #334155;
                    margin-bottom: 1.5rem;
                }

                /* Dark Theme Variant Overrides for Kabinet */
                .visi-misi-dark h3 {
                    background: rgba(255, 255, 255, 0.1) !important;
                    color: #38bdf8 !important;
                    border: 1px solid rgba(56, 189, 248, 0.25) !important;
                }
                .visi-misi-dark p {
                    color: #f1f5f9 !important;
                    background: rgba(15, 23, 42, 0.6) !important;
                    border-left-color: #38bdf8 !important;
                }
                .visi-misi-dark ol li {
                    background: rgba(15, 23, 42, 0.7) !important;
                    border-color: rgba(255, 255, 255, 0.1) !important;
                    color: #cbd5e1 !important;
                }
                .visi-misi-dark ol li:hover {
                    border-color: rgba(56, 189, 248, 0.4) !important;
                    background: rgba(15, 23, 42, 0.9) !important;
                }
                .visi-misi-dark ol li::before {
                    background: #38bdf8 !important;
                    color: #0f172a !important;
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
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 text-white p-8 md:p-12 shadow-2xl border border-slate-800">
                {{-- Decorative Glow --}}
                <div class="absolute -top-32 -right-32 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-6xl mx-auto space-y-10">
                    {{-- Header Badges --}}
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-800/80 pb-6">
                        <div class="space-y-2">
                            <span class="inline-flex items-center gap-2 rounded-full bg-blue-500/10 border border-blue-400/20 px-3.5 py-1 text-xs font-bold uppercase tracking-widest text-blue-400">
                                <i class="fas fa-bullhorn text-[10px]"></i>
                                {{ $visiMisiKabinet->subtitle ?: 'HMIF 2024/2025' }}
                            </span>
                            <h2 class="text-3xl lg:text-4xl font-extrabold text-white tracking-tight">{{ $visiMisiKabinet->title }}</h2>
                        </div>
                        <p class="text-slate-400 text-xs font-mono uppercase tracking-wider">Himpunan Mahasiswa Teknik Informatika ITATS</p>
                    </div>

                    {{-- Dynamic Visi & Misi Layout --}}
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        {{-- Visi Card (Span 5) --}}
                        <div class="lg:col-span-5 bg-slate-800/60 rounded-2xl p-6 md:p-8 border border-slate-700/60 shadow-lg relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-bl-full transition-all group-hover:scale-110"></div>
                            <div class="flex items-center gap-2.5 mb-4">
                                <span class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center text-xs font-black">01</span>
                                <h3 class="text-sm font-extrabold uppercase tracking-widest text-blue-400">Visi Utama</h3>
                            </div>
                            <blockquote class="text-slate-200 text-sm md:text-base leading-relaxed font-medium italic border-l-2 border-blue-400 pl-4 py-1">
                                "Terwujudnya Himpunan Mahasiswa Teknik Informatika (HMIF ITATS) sebagai wadah pergerakan yang inklusif, adaptif, profesional, dan berorientasi pada pengembangan potensi berasaskan kekeluargaan serta inovasi teknologi."
                            </blockquote>
                        </div>

                        {{-- Misi Cards Grid (Span 7) --}}
                        <div class="lg:col-span-7 space-y-4">
                            <div class="flex items-center gap-2.5 mb-2">
                                <span class="w-7 h-7 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center text-xs font-black">02</span>
                                <h3 class="text-sm font-extrabold uppercase tracking-widest text-purple-400">Misi Pergerakan</h3>
                            </div>
                            <div class="grid grid-cols-1 gap-3">
                                <div class="bg-slate-800/40 p-4 rounded-xl border border-slate-700/40 flex items-start gap-3 hover:border-slate-600 transition-all hover:translate-x-1">
                                    <span class="w-6 h-6 rounded-md bg-slate-700 text-slate-300 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                                    <p class="text-xs md:text-sm text-slate-300 leading-relaxed font-medium">Memperkuat tata kelola internal organisasi secara profesional, transparan, dan akuntabel.</p>
                                </div>
                                <div class="bg-slate-800/40 p-4 rounded-xl border border-slate-700/40 flex items-start gap-3 hover:border-slate-600 transition-all hover:translate-x-1">
                                    <span class="w-6 h-6 rounded-md bg-slate-700 text-slate-300 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                                    <p class="text-xs md:text-sm text-slate-300 leading-relaxed font-medium">Menyediakan ruang kreasi, penelitian, dan inovasi teknologi bagi seluruh mahasiswa Teknik Informatika ITATS.</p>
                                </div>
                                <div class="bg-slate-800/40 p-4 rounded-xl border border-slate-700/40 flex items-start gap-3 hover:border-slate-600 transition-all hover:translate-x-1">
                                    <span class="w-6 h-6 rounded-md bg-slate-700 text-slate-300 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                                    <p class="text-xs md:text-sm text-slate-300 leading-relaxed font-medium">Mempererat tali kekeluargaan, solidaritas, dan kolaborasi antar mahasiswa, alumni, serta elemen akademis ITATS.</p>
                                </div>
                                <div class="bg-slate-800/40 p-4 rounded-xl border border-slate-700/40 flex items-start gap-3 hover:border-slate-600 transition-all hover:translate-x-1">
                                    <span class="w-6 h-6 rounded-md bg-slate-700 text-slate-300 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">4</span>
                                    <p class="text-xs md:text-sm text-slate-300 leading-relaxed font-medium">Meningkatkan peran aktif HMIF ITATS dalam kegiatan pengabdian masyarakat dan jejaring keorganisasian tingkat regional maupun nasional.</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
