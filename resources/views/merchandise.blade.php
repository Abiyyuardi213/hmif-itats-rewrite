@extends('layouts.app')

@section('title', 'Official Merchandise - HMIF ITATS')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 bg-white overflow-hidden">
        <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
            <div class="mb-14 text-center">
                <div
                    class="inline-flex items-center gap-2 mb-6 bg-white border border-slate-100 px-3 py-1 rounded-full w-fit shadow-sm mx-auto">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    <span class="text-[11px] font-medium text-slate-500 tracking-tight">Koleksi Eksklusif • Kualitas Premium
                        • Bangga Informatika</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-6 tracking-tight">Official
                    Merchandise</h1>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed">
                    Tunjukkan identitasmu sebagai bagian dari keluarga besar Informatika ITATS dengan koleksi merchandise
                    eksklusif kami.
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Product 1 -->
                <div class="group">
                    <div
                        class="relative aspect-square rounded-3xl overflow-hidden bg-slate-100 border border-slate-200 mb-5 shadow-sm transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="HMIF Official Hoodie"
                            class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 focus:outline-none">
                            <span
                                class="bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-lg shadow-primary/20 uppercase tracking-widest">Terlaris</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Outerwear</span>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                            HMIF Core Hoodie 2024</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-black text-xl">Rp 185.000</span>
                            <a href="#"
                                class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center hover:bg-primary transition-colors shadow-lg shadow-slate-900/10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="group">
                    <div
                        class="relative aspect-square rounded-3xl overflow-hidden bg-slate-100 border border-slate-200 mb-5 shadow-sm transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="HMIF Basic Tee"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">T-Shirt</span>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                            Informatika Oversize Tee</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-black text-xl">Rp 95.000</span>
                            <a href="#"
                                class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center hover:bg-primary transition-colors shadow-lg shadow-slate-900/10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="group">
                    <div
                        class="relative aspect-square rounded-3xl overflow-hidden bg-slate-100 border border-slate-200 mb-5 shadow-sm transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="HMIF Totebag"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Accessories</span>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                            HMIF Canvas Totebag</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-black text-xl">Rp 45.000</span>
                            <a href="#"
                                class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center hover:bg-primary transition-colors shadow-lg shadow-slate-900/10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="group">
                    <div
                        class="relative aspect-square rounded-3xl overflow-hidden bg-slate-100 border border-slate-200 mb-5 shadow-sm transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="HMIF Sticker Pack"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Essentials</span>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                            Premium Sticker Pack</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-black text-xl">Rp 15.000</span>
                            <a href="#"
                                class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center hover:bg-primary transition-colors shadow-lg shadow-slate-900/10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="mt-24 bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl -ml-32 -mb-32"></div>

                <h2 class="text-3xl md:text-4xl font-black text-white mb-6 relative z-10">Ingin custom atau tanya stok?</h2>
                <p class="text-slate-400 font-medium mb-10 max-w-xl mx-auto relative z-10">
                    Tim merchandise kami siap melayani pemesanan skala besar atau merchandise custom untuk acara divisi.
                </p>
                <a href="#"
                    class="relative z-10 inline-flex items-center gap-2 px-10 py-4 bg-primary text-white font-bold rounded-2xl hover:scale-105 transition-all shadow-xl shadow-primary/30">
                    Hubungi Admin Merchandise
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
