@extends('layouts.app')

@section('title', 'Merchandise - HMIF ITATS')

@section('content')
    <div class="min-h-screen bg-slate-50/50">
        {{-- Header Section --}}
        <section class="relative bg-white border-b border-slate-200">
            <div class="container mx-auto px-6 py-16 md:py-24 text-center">
                <div class="max-w-3xl mx-auto space-y-6">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-600 transition-colors hover:bg-slate-100 hover:text-slate-900 cursor-default">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Official Merchandise
                    </div>
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-4">
                            Koleksi HMIF ITATS
                        </h1>
                        <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                            Tunjukkan identitasmu sebagai bagian dari keluarga besar Informatika ITATS dengan merchandise
                            eksklusif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Product Grid Section --}}
        <section class="py-12 px-6">
            <div class="container mx-auto max-w-7xl">
                @if ($merchandises->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($merchandises as $m)
                            <div
                                class="group bg-white rounded-lg border border-slate-200 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col overflow-hidden">
                                {{-- Image Container --}}
                                <div class="aspect-square relative bg-slate-100 border-b border-slate-100 overflow-hidden">
                                    @if ($m->image)
                                        <img src="{{ asset('storage/' . $m->image) }}" alt="{{ $m->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif

                                    {{-- Badges --}}
                                    <div class="absolute top-3 left-3 flex flex-col gap-2">
                                        @if ($m->category)
                                            <span
                                                class="inline-flex px-2 py-1 bg-white/90 backdrop-blur rounded-md border border-slate-200 text-[10px] font-semibold text-slate-700 uppercase tracking-wide shadow-sm">
                                                {{ $m->category }}
                                            </span>
                                        @endif
                                    </div>

                                    @if ($m->stock <= 5)
                                        <div class="absolute top-3 right-3">
                                            <span
                                                class="inline-flex px-2 py-1 bg-rose-50 border border-rose-200 text-rose-600 rounded-md text-[10px] font-bold uppercase tracking-wide shadow-sm">
                                                Stok Terbatas
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="p-5 flex flex-col flex-1">
                                    <div class="mb-4">
                                        <h3
                                            class="font-semibold text-slate-900 text-lg leading-tight group-hover:text-blue-600 transition-colors line-clamp-1">
                                            {{ $m->name }}
                                        </h3>
                                        <p class="text-slate-500 text-sm mt-1.5 line-clamp-2 leading-relaxed">
                                            {{ $m->description }}
                                        </p>
                                    </div>

                                    @if ($m->sizes && count($m->sizes) > 0)
                                        <div class="mb-4">
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach ($m->sizes as $size)
                                                    <span
                                                        class="px-2 py-0.5 bg-slate-50 border border-slate-200 text-slate-600 rounded text-[10px] font-medium uppercase">
                                                        {{ $size }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mt-auto space-y-4">
                                        <div class="flex items-end justify-between border-t border-slate-100 pt-3">
                                            <div>
                                                <p
                                                    class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-0.5">
                                                    Harga</p>
                                                <div class="text-slate-900 font-bold text-lg">
                                                    Rp {{ number_format($m->price, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p
                                                    class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-0.5">
                                                    Stok</p>
                                                <div class="text-slate-700 font-semibold text-sm">
                                                    {{ $m->stock }}
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('merchandise.show', $m->slug) }}"
                                            class="inline-flex items-center justify-center gap-2 w-full py-2.5 bg-slate-900 text-slate-50 rounded-md font-medium text-sm hover:bg-slate-800 transition-all shadow-sm active:scale-95 border border-transparent hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                            Detail Produk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-24 bg-white border border-dashed border-slate-300 rounded-lg">
                        <div
                            class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900">Belum Ada Produk</h3>
                        <p class="text-slate-500 text-sm mt-1">Nantikan koleksi merchandise terbaru kami.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- Contact/CTA Section --}}
        <section class="py-16 border-t border-slate-200 bg-white">
            <div class="container mx-auto px-6 text-center">
                <div class="max-w-2xl mx-auto space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Pemesanan Custom</h2>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed">
                            Kami melayani pemesanan merchandise custom untuk keperluan divisi atau event dalam jumlah besar.
                            Hubungi kami untuk informasi lebih lanjut.
                        </p>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="inline-flex items-center gap-2 rounded-md bg-white border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 active:scale-95 transition-all">
                        <svg class="h-4 w-4 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
