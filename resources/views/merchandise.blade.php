@extends('layouts.app')

@section('title', 'Official Merchandise - HMIF ITATS')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-12 md:py-20 overflow-hidden bg-white mt-[-1px]">
        <!-- Radial Gradient Background -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_-20%,rgba(244,114,182,0.12),rgba(255,255,255,0))]">
        </div>

        <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12 relative">
            <div class="mb-16 text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-pink-100 bg-pink-50/50 px-3 py-1.5 text-[10px] font-bold text-pink-500 mb-5 backdrop-blur-sm shadow-sm uppercase tracking-widest">
                    <i class="fas fa-shopping-bag"></i>
                    Koleksi Eksklusif HMIF
                </div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900 mb-5 leading-[1.1]">
                    Official <br>
                    <span class="text-pink-500">Merchandise</span>
                </h1>
                <p class="text-base text-slate-500 max-w-xl mx-auto leading-relaxed font-medium opacity-90">
                    Tunjukkan identitasmu sebagai bagian dari keluarga besar Informatika ITATS dengan koleksi merchandise
                    eksklusif kami.
                </p>
            </div>

            <!-- Products Grid (More compact: 2 on mobile, 3 on tablet, 4 on lg, 5 on xl) -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                <!-- Product 1 -->
                <div
                    class="group bg-white rounded-[2rem] p-3 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-slate-50 mb-4">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="HMIF Core Hoodie 2024"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-2 right-2">
                            <span
                                class="bg-amber-500 text-white text-[8px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter">Terlaris</span>
                        </div>
                    </div>
                    <div class="px-1 pb-2">
                        <span
                            class="text-[9px] font-bold text-pink-500 uppercase tracking-widest mb-1 block">Outerwear</span>
                        <h3
                            class="text-sm font-black text-slate-900 mb-2 truncate group-hover:text-pink-500 transition-colors">
                            HMIF Core Hoodie 2024</h3>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-slate-900 font-black text-sm">Rp 185k</span>
                            <a href="#"
                                class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center hover:bg-pink-500 transition-colors shadow-sm">
                                <i class="fas fa-cart-plus text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div
                    class="group bg-white rounded-[2rem] p-3 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-slate-50 mb-4">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="Informatika Oversize Tee"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="px-1 pb-2">
                        <span class="text-[9px] font-bold text-pink-500 uppercase tracking-widest mb-1 block">T-Shirt</span>
                        <h3
                            class="text-sm font-black text-slate-900 mb-2 truncate group-hover:text-pink-500 transition-colors">
                            Informatika Oversize Tee</h3>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-slate-900 font-black text-sm">Rp 95k</span>
                            <a href="#"
                                class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center hover:bg-pink-500 transition-colors shadow-sm">
                                <i class="fas fa-cart-plus text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div
                    class="group bg-white rounded-[2rem] p-3 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-slate-50 mb-4">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="HMIF Canvas Totebag"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-2 right-2">
                            <span
                                class="bg-pink-500 text-white text-[8px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter">New</span>
                        </div>
                    </div>
                    <div class="px-1 pb-2">
                        <span
                            class="text-[9px] font-bold text-pink-500 uppercase tracking-widest mb-1 block">Accessories</span>
                        <h3
                            class="text-sm font-black text-slate-900 mb-2 truncate group-hover:text-pink-500 transition-colors">
                            HMIF Canvas Totebag</h3>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-slate-900 font-black text-sm">Rp 45k</span>
                            <a href="#"
                                class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center hover:bg-pink-500 transition-colors shadow-sm">
                                <i class="fas fa-cart-plus text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div
                    class="group bg-white rounded-[2rem] p-3 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-slate-50 mb-4">
                        <img src="https://api.luckysf.com/api/placeholder/600/600" alt="Premium Sticker Pack"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="px-1 pb-2">
                        <span
                            class="text-[9px] font-bold text-pink-500 uppercase tracking-widest mb-1 block">Essentials</span>
                        <h3
                            class="text-sm font-black text-slate-900 mb-2 truncate group-hover:text-pink-500 transition-colors">
                            Premium Sticker Pack</h3>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-slate-900 font-black text-sm">Rp 15k</span>
                            <a href="#"
                                class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center hover:bg-pink-500 transition-colors shadow-sm">
                                <i class="fas fa-cart-plus text-xs"></i>
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
