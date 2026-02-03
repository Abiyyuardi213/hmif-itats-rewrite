@extends('layouts.app')

@section('title', 'Status Pesanan - ' . $order->transaction_id)

@section('content')
    <div class="min-h-screen bg-slate-50/50">
        {{-- Header Section --}}
        <section class="relative bg-white py-8 border-b border-slate-200">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto space-y-4">
                    <nav class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-2">
                        <a href="{{ route('merchandise.index') }}" class="hover:text-slate-900 transition-colors">Katalog</a>
                        <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-slate-900">Status Pesanan</span>
                    </nav>

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Status Pesanan</h1>
                            <p class="text-sm text-slate-500 mt-1">ID Transaksi: <span
                                    class="font-mono text-slate-700 font-medium">{{ $order->transaction_id }}</span></p>
                        </div>

                        @php
                            $statusData = [
                                'pending' => [
                                    'bg' => 'bg-amber-50',
                                    'text' => 'text-amber-700',
                                    'border' => 'border-amber-200',
                                    'label' => 'Menunggu Pembayaran',
                                    'icon' => 'fa-clock',
                                ],
                                'confirmed' => [
                                    'bg' => 'bg-blue-50',
                                    'text' => 'text-blue-700',
                                    'border' => 'border-blue-200',
                                    'label' => 'Dikonfirmasi',
                                    'icon' => 'fa-check-circle',
                                ],
                                'processing' => [
                                    'bg' => 'bg-purple-50',
                                    'text' => 'text-purple-700',
                                    'border' => 'border-purple-200',
                                    'label' => 'Sedang Diproses',
                                    'icon' => 'fa-cog fa-spin',
                                ],
                                'shipped' => [
                                    'bg' => 'bg-indigo-50',
                                    'text' => 'text-indigo-700',
                                    'border' => 'border-indigo-200',
                                    'label' => 'Sedang Dikirim',
                                    'icon' => 'fa-shipping-fast',
                                ],
                                'completed' => [
                                    'bg' => 'bg-emerald-50',
                                    'text' => 'text-emerald-700',
                                    'border' => 'border-emerald-200',
                                    'label' => 'Selesai',
                                    'icon' => 'fa-box-open',
                                ],
                                'cancelled' => [
                                    'bg' => 'bg-rose-50',
                                    'text' => 'text-rose-700',
                                    'border' => 'border-rose-200',
                                    'label' => 'Dibatalkan',
                                    'icon' => 'fa-times-circle',
                                ],
                            ];
                            $current = $statusData[$order->status] ?? $statusData['pending'];
                        @endphp

                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md border {{ $current['border'] }} {{ $current['bg'] }} {{ $current['text'] }} text-xs font-semibold shadow-sm">
                            <i class="fas {{ $current['icon'] }}"></i>
                            {{ $current['label'] }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 px-6">
            <div class="container mx-auto max-w-5xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    {{-- Left Column: Tracking & Info (8/12) --}}
                    <div class="lg:col-span-8 space-y-6">

                        {{-- Timeline --}}
                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                            <h3 class="text-sm font-semibold text-slate-900 border-b border-slate-100 pb-4 mb-6">Lacak
                                Pesanan</h3>

                            <div class="relative pl-4 border-l-2 border-slate-100 space-y-8 ml-2">
                                {{-- Step 1: Pesanan Dibuat --}}
                                <div class="relative">
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full border-2 border-white ring-1 ring-slate-200 bg-slate-100 flex items-center justify-center">
                                        <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-slate-900">Pesanan Dibuat</h4>
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            {{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                                    </div>
                                </div>

                                {{-- Step 2: Pembayaran --}}
                                <div class="relative">
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full border-2 border-white ring-1 {{ $order->paid_at ? 'ring-emerald-200 bg-emerald-50' : ($order->status == 'cancelled' ? 'ring-rose-200 bg-rose-50' : 'ring-amber-200 bg-amber-50') }} flex items-center justify-center">
                                        @if ($order->paid_at)
                                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        @elseif($order->status == 'cancelled')
                                            <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                                        @else
                                            <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h4
                                            class="text-sm font-medium {{ $order->paid_at ? 'text-slate-900' : ($order->status == 'cancelled' ? 'text-rose-600' : 'text-slate-900') }}">
                                            {{ $order->paid_at ? 'Pembayaran Diterima' : ($order->status == 'cancelled' ? 'Pesanan Dibatalkan' : 'Menunggu Konfirmasi Pembayaran') }}
                                        </h4>
                                        @if ($order->paid_at)
                                            <p class="text-xs text-slate-500 mt-0.5">
                                                {{ \Carbon\Carbon::parse($order->paid_at)->translatedFormat('d F Y, H:i') }}
                                                WIB</p>
                                            <p
                                                class="text-xs text-emerald-600 mt-1 font-medium bg-emerald-50 inline-block px-2 py-0.5 rounded border border-emerald-100">
                                                <i class="fas fa-check-circle mr-1"></i> Bukti Valid
                                            </p>
                                        @elseif($order->status == 'cancelled')
                                            <p class="text-xs text-rose-500 mt-0.5">Pesanan telah dibatalkan.</p>
                                        @elseif($order->status == 'pending')
                                            <p class="text-xs text-amber-600 mt-0.5">Admin sedang memverifikasi bukti
                                                pembayaran Anda.</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Step 3: Proses & Kirim --}}
                                <div class="relative">
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full border-2 border-white ring-1 ring-slate-200 bg-slate-100 flex items-center justify-center">
                                        @if (in_array($order->status, ['processing', 'shipped', 'completed']))
                                            <div class="w-2 h-2 rounded-full bg-slate-900"></div>
                                        @else
                                            <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                        @endif
                                    </div>
                                    <div
                                        class="ml-4 {{ in_array($order->status, ['processing', 'shipped', 'completed']) ? 'opacity-100' : 'opacity-50' }}">
                                        <h4 class="text-sm font-medium text-slate-900">Proses & Pengiriman</h4>
                                        <p class="text-xs text-slate-500 mt-0.5">Pesanan diproses dan dikirim ke alamat
                                            tujuan.</p>
                                    </div>
                                </div>

                                {{-- Step 4: Selesai --}}
                                <div class="relative">
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full border-2 border-white ring-1 ring-slate-200 bg-slate-100 flex items-center justify-center">
                                        @if ($order->status == 'completed')
                                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        @else
                                            <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                        @endif
                                    </div>
                                    <div class="ml-4 {{ $order->status == 'completed' ? 'opacity-100' : 'opacity-50' }}">
                                        <h4 class="text-sm font-medium text-slate-900">Pesanan Selesai</h4>
                                        <p class="text-xs text-slate-500 mt-0.5">Terima kasih telah berbelanja di HMIF
                                            ITATS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delivery Info --}}
                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-6">
                            <h3 class="text-sm font-semibold text-slate-900 border-b border-slate-100 pb-4">Info Pengiriman
                            </h3>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 shrink-0">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Penerima
                                    </p>
                                    <p class="text-sm font-medium text-slate-900">{{ $order->customer_name }}</p>
                                    <p class="text-sm text-slate-600 mt-1 leading-relaxed">{{ $order->customer_address }}
                                    </p>
                                    <p class="text-sm text-slate-600 mt-1 flex items-center gap-2">
                                        <i class="fas fa-phone text-xs text-slate-400"></i> {{ $order->customer_phone }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Summary (4/12) --}}
                    <div class="lg:col-span-4 space-y-6">
                        {{-- Order Summary --}}
                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                            <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Item Pesanan</h3>
                            </div>
                            <div class="p-6">
                                <div class="flex gap-4 mb-6">
                                    <div
                                        class="w-16 h-16 rounded-md bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                                        <img src="{{ $order->merchandise->image ? asset('storage/' . $order->merchandise->image) : asset('image/icon-hmif.png') }}"
                                            alt="{{ $order->merchandise->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-slate-900 line-clamp-2">
                                            {{ $order->merchandise->name }}</h4>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <span
                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                Qty: {{ $order->quantity }}
                                            </span>
                                            @if ($order->size)
                                                <span
                                                    class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                    Size: {{ $order->size }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-3 pt-6 border-t border-slate-100">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-slate-500">Total Harga</span>
                                        <span class="font-bold text-slate-900">Rp
                                            {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-900 rounded-lg p-6 shadow-md text-center">
                            <p class="text-xs text-slate-300 mb-4 leading-relaxed">
                                Butuh bantuan terkait pesanan ini? Hubungi admin kami.
                            </p>
                            <a href="https://wa.me/628xxyyyzz?text=Halo%20Admin,%20saya%20butuh%20bantuan%20pesanan%20{{ $order->transaction_id }}"
                                target="_blank"
                                class="inline-flex items-center justify-center w-full px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-md transition-colors shadow-sm">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi Admin
                            </a>
                            <a href="{{ route('merchandise.index') }}"
                                class="block mt-4 text-xs text-slate-400 hover:text-white transition-colors">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Katalog
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
