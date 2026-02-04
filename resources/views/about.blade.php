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
