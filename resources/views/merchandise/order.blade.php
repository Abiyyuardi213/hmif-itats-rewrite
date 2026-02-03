@extends('layouts.app')

@section('title', 'Form Pemesanan - ' . $merchandise->name)

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
                        <a href="{{ route('merchandise.show', $merchandise->slug) }}"
                            class="hover:text-slate-900 transition-colors truncate max-w-[150px]">{{ $merchandise->name }}</a>
                        <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-slate-900">Pemesanan</span>
                    </nav>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">Form Pemesanan</h1>
                </div>
            </div>
        </section>

        {{-- Main Form Section --}}
        <section class="py-12 px-6">
            <div class="container mx-auto max-w-5xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    {{-- Left: Order Summary (4/12) --}}
                    <div class="lg:col-span-4 space-y-4">
                        <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm space-y-6">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ringkasan Pesanan</h3>

                            <div class="flex gap-4 items-center">
                                <div
                                    class="w-16 h-16 rounded-md bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                                    <img src="{{ $merchandise->image ? asset('storage/' . $merchandise->image) : asset('image/icon-hmif.png') }}"
                                        alt="{{ $merchandise->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-semibold text-slate-900 text-sm truncate">{{ $merchandise->name }}</h4>
                                    <p class="text-xs font-medium text-slate-500 mt-1">
                                        Rp {{ number_format($merchandise->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-slate-100 space-y-1">
                                <div
                                    class="flex justify-between items-center text-xs font-medium text-slate-500 uppercase tracking-wide">
                                    <span>Estimasi Total</span>
                                </div>
                                <div class="text-xl font-bold text-slate-900" id="live-total">
                                    Rp {{ number_format($merchandise->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100 flex gap-3">
                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <div class="text-xs font-medium text-blue-900 leading-relaxed">
                                Data Anda aman bersama kami. Silakan lengkapi form di samping untuk melanjutkan ke
                                pembayaran.
                            </div>
                        </div>
                    </div>

                    {{-- Right: Form Input (8/12) --}}
                    <div class="lg:col-span-8">
                        <div class="bg-white rounded-lg p-6 md:p-8 border border-slate-200 shadow-sm">
                            <form action="{{ route('merchandise.order.store', $merchandise->slug) }}" method="POST"
                                class="space-y-8">
                                @csrf

                                {{-- Step 1: Info --}}
                                <div class="space-y-6">
                                    <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                                        <div
                                            class="w-6 h-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs font-bold">
                                            1</div>
                                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Informasi
                                            Pembeli</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-1.5">
                                            <label class="text-xs font-semibold text-slate-700">Nama Lengkap</label>
                                            <input type="text" name="customer_name" required
                                                placeholder="Contoh: Muhammad Rafli"
                                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all placeholder:text-slate-400">
                                        </div>

                                        <div class="space-y-1.5">
                                            <label class="text-xs font-semibold text-slate-700">Alamat Email</label>
                                            <input type="email" name="customer_email" required
                                                placeholder="email@student.itats.ac.id"
                                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all placeholder:text-slate-400">
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-slate-700">No. WhatsApp</label>
                                        <input type="tel" name="customer_phone" required placeholder="081234567890"
                                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all placeholder:text-slate-400">
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-slate-700">Alamat Lengkap</label>
                                        <textarea name="customer_address" required rows="3" placeholder="Jl. Arief Rahman Hakim No.100, Surabaya"
                                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none placeholder:text-slate-400"></textarea>
                                    </div>
                                </div>

                                {{-- Step 2: Detail --}}
                                <div class="space-y-6 pt-4">
                                    <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                                        <div
                                            class="w-6 h-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs font-bold">
                                            2</div>
                                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Detail Pesanan
                                        </h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @if ($merchandise->sizes && count($merchandise->sizes) > 0)
                                            <div class="space-y-1.5">
                                                <label class="text-xs font-semibold text-slate-700">Pilih Ukuran</label>
                                                <div class="relative">
                                                    <select name="size" required
                                                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all appearance-none cursor-pointer">
                                                        <option value="">-- Pilih size --</option>
                                                        @foreach ($merchandise->sizes as $size)
                                                            <option value="{{ $size }}"
                                                                {{ request('size') == $size ? 'selected' : '' }}>
                                                                {{ $size }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div
                                                        class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="space-y-1.5">
                                            <label class="text-xs font-semibold text-slate-700">Jumlah</label>
                                            <input type="number" name="quantity" id="quantity_input" required
                                                min="1" max="{{ $merchandise->stock }}" value="1"
                                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-slate-700">Catatan (Optional)</label>
                                        <textarea name="notes" rows="2" placeholder="Tuliskan jika ada permintaan khusus"
                                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none placeholder:text-slate-400"></textarea>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full py-3 bg-slate-900 text-white rounded-md font-bold text-sm hover:bg-slate-800 transition-all shadow-sm active:scale-[0.98]">
                                        Konfirmasi & Lanjut Bayar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script>
        const price = {{ $merchandise->price }};
        const quantityInput = document.getElementById('quantity_input');
        const liveTotal = document.getElementById('live-total');

        if (quantityInput) {
            quantityInput.addEventListener('input', (e) => {
                const qty = parseInt(e.target.value) || 0;
                const total = price * qty;
                liveTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
            });
        }
    </script>
@endsection
