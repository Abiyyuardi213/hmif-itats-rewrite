@extends('layouts.app')

@section('title', $merchandise->name . ' - Merchandise HMIF ITATS')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-24 pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <a href="{{ route('merchandise.index') }}"
                class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-primary transition-colors mb-6 group">
                <i class="fas fa-arrow-left mr-2 text-xs group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Merchandise
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-lg">
                    <div class="aspect-square bg-slate-100">
                        @if ($merchandise->image)
                            <img src="{{ asset('storage/' . $merchandise->image) }}" alt="{{ $merchandise->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i class="fas fa-tshirt text-8xl"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Details & Order Form -->
                <div class="space-y-6">
                    <!-- Product Info -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-lg">
                        @if ($merchandise->category)
                            <span
                                class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold uppercase tracking-widest mb-4">
                                {{ $merchandise->category }}
                            </span>
                        @endif

                        <h1 class="text-3xl font-extrabold text-slate-900 mb-4">{{ $merchandise->name }}</h1>

                        <div class="flex items-baseline gap-4 mb-6">
                            <p class="text-4xl font-bold text-primary">Rp
                                {{ number_format($merchandise->price, 0, ',', '.') }}</p>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-bold {{ $merchandise->stock > 10 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                Stok: {{ $merchandise->stock }} unit
                            </span>
                        </div>

                        <div class="prose prose-slate max-w-none mb-6">
                            <p class="text-slate-600 leading-relaxed">{{ $merchandise->description }}</p>
                        </div>

                        @if ($merchandise->sizes && count($merchandise->sizes) > 0)
                            <div class="pt-4 border-t border-slate-100">
                                <p class="text-sm font-semibold text-slate-700 mb-3">Ukuran Tersedia:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($merchandise->sizes as $size)
                                        <span
                                            class="px-4 py-2 bg-slate-100 text-slate-900 rounded-lg text-sm font-bold">{{ $size }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Order Form -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-lg">
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            Form Pemesanan
                        </h2>

                        <form action="{{ route('merchandise.order', $merchandise) }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama
                                        Lengkap <span class="text-rose-500">*</span></label>
                                    <input type="text" name="customer_name" required placeholder="Nama Anda"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Email <span
                                            class="text-rose-500">*</span></label>
                                    <input type="email" name="customer_email" required placeholder="email@example.com"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">No. WhatsApp
                                    <span class="text-rose-500">*</span></label>
                                <input type="tel" name="customer_phone" required placeholder="08xxxxxxxxxx"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Alamat Lengkap
                                    <span class="text-rose-500">*</span></label>
                                <textarea name="customer_address" required rows="3" placeholder="Alamat pengiriman..."
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if ($merchandise->sizes && count($merchandise->sizes) > 0)
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Ukuran
                                            <span class="text-rose-500">*</span></label>
                                        <select name="size" required
                                            class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                            <option value="">Pilih Ukuran</option>
                                            @foreach ($merchandise->sizes as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Jumlah
                                        <span class="text-rose-500">*</span></label>
                                    <input type="number" name="quantity" required min="1"
                                        max="{{ $merchandise->stock }}" value="1"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Catatan
                                    (Opsional)</label>
                                <textarea name="notes" rows="2" placeholder="Catatan tambahan untuk pesanan..."
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none"></textarea>
                            </div>

                            <div class="pt-4 border-t border-slate-100">
                                <button type="submit"
                                    class="w-full py-4 bg-slate-900 text-white rounded-lg font-bold text-base hover:bg-slate-800 transition-all shadow-lg hover:shadow-xl active:scale-[0.98]">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Kirim Pesanan
                                </button>
                                <p class="text-xs text-slate-500 text-center mt-3">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Kami akan menghubungi Anda melalui WhatsApp untuk konfirmasi pembayaran
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
