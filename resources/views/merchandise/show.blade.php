@extends('layouts.app')

@section('title', $merchandise->name . ' - Merchandise HMIF ITATS')

@section('content')
    <div class="min-h-screen bg-slate-50/50">
        {{-- Slim Header Section --}}
        <section class="relative bg-white py-8 border-b border-slate-200">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto">
                    <nav class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-2">
                        <a href="{{ route('merchandise.index') }}" class="hover:text-slate-900 transition-colors">Katalog</a>
                        <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-slate-900">Detail Produk</span>
                    </nav>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">
                        {{ $merchandise->name }}
                    </h1>
                </div>
            </div>
        </section>

        {{-- Main Content Section --}}
        <section class="py-8 px-6">
            <div class="container mx-auto max-w-5xl">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

                    {{-- Left: Image Gallery (6/12) --}}
                    <div class="md:col-span-6 space-y-4">
                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                            <div class="aspect-square bg-slate-100 overflow-hidden relative">
                                @if ($merchandise->image)
                                    <img src="{{ asset('storage/' . $merchandise->image) }}" alt="{{ $merchandise->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                @endif

                                @if ($merchandise->category)
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="inline-flex px-2.5 py-1 bg-white/90 backdrop-blur rounded-md border border-slate-200 text-xs font-semibold text-slate-700 uppercase tracking-wide shadow-sm">
                                            {{ $merchandise->category }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Quality Badges --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-white p-3 rounded-lg border border-slate-200 shadow-sm flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-md bg-slate-100 flex items-center justify-center text-slate-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wide">Premium
                                    Quality</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg border border-slate-200 shadow-sm flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-md bg-slate-100 flex items-center justify-center text-slate-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wide">Original
                                    Design</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Information (6/12) --}}
                    <div class="md:col-span-6 space-y-6">
                        <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm space-y-6">
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Harga &
                                        Stok</span>
                                    <span
                                        class="text-xs font-medium text-slate-600 px-2 py-0.5 bg-slate-100 rounded border border-slate-200 uppercase tracking-wide">
                                        Tersedia: {{ $merchandise->stock }} unit
                                    </span>
                                </div>
                                <div class="text-3xl font-bold text-slate-900">
                                    Rp {{ number_format($merchandise->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="pt-6 border-t border-slate-100">
                                <h3
                                    class="flex items-center gap-2 text-xs font-bold text-slate-900 uppercase tracking-wide mb-3">
                                    Deskripsi Produk
                                </h3>
                                <div class="text-slate-600 text-sm leading-relaxed prose prose-slate">
                                    {{ $merchandise->description }}
                                </div>
                            </div>

                            @if ($merchandise->sizes && count($merchandise->sizes) > 0)
                                <div class="pt-6 border-t border-slate-100">
                                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wide mb-3">Pilih Ukuran
                                    </h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($merchandise->sizes as $size)
                                            <a href="{{ route('merchandise.order.create', $merchandise->slug) }}?size={{ $size }}"
                                                class="px-4 py-2 bg-white border border-slate-200 rounded-md text-sm font-medium text-slate-700 hover:border-slate-900 hover:text-slate-900 transition-all flex items-center justify-center min-w-[3rem] shadow-sm">
                                                {{ $size }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="pt-6">
                                <a href="{{ route('merchandise.order.create', $merchandise->slug) }}"
                                    class="flex items-center justify-center gap-2 w-full py-3 bg-slate-900 text-white rounded-md font-bold text-sm hover:bg-slate-800 transition-all shadow-sm active:scale-95">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>

                        {{-- PO Warning --}}
                        <div class="bg-amber-50 rounded-lg p-4 border border-amber-100 flex gap-3">
                            <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-xs text-amber-900 leading-relaxed font-medium">
                                Sesi pre-order akan diproses setelah kuota terpenuhi atau jadwal PO berakhir. Estimasi 7-14
                                hari kerja.
                            </div>
                        </div>

                        {{-- Back Button --}}
                        <a href="{{ route('merchandise.index') }}"
                            class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-900 transition-colors pl-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Katalog
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
