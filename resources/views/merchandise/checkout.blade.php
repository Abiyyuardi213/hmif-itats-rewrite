@extends('layouts.app')

@section('title', 'Pembayaran - ' . $order->transaction_id)

@section('content')
    <div class="min-h-screen bg-slate-50/50">
        {{-- Header Section --}}
        <section class="relative bg-white py-8 border-b border-slate-200">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <nav class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-2">
                                <a href="{{ route('merchandise.index') }}"
                                    class="hover:text-slate-900 transition-colors">Katalog</a>
                                <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="text-slate-900">Pembayaran</span>
                            </nav>
                            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selesaikan Pembayaran</h1>
                            <p class="text-sm text-slate-500 mt-1">ID Transaksi: <span
                                    class="font-mono text-slate-700 font-medium">{{ $order->transaction_id }}</span></p>
                        </div>

                        @if ($order->status == 'cancelled')
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 bg-rose-50 border border-rose-200 rounded-md text-xs font-semibold text-rose-700">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pesanan Dibatalkan
                            </div>
                        @else
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 border border-amber-200 rounded-md text-xs font-semibold text-amber-700">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                </span>
                                Menunggu Pembayaran
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 px-6">
            <div class="container mx-auto max-w-5xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    {{-- Left Column: Payment Detail & Timer (7/12) --}}
                    <div class="lg:col-span-7 space-y-6">

                        {{-- Timer Card --}}
                        <div class="bg-slate-900 rounded-lg p-6 text-white shadow-lg overflow-hidden relative">
                            <div class="absolute top-0 right-0 p-3 opacity-10">
                                <svg class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Sisa Waktu
                                Pembayaran</h3>
                            <div class="text-4xl font-bold font-mono tracking-tight" id="countdown">00:00:00</div>
                            <p class="text-xs text-slate-400 mt-4">Batas Akhir: <span
                                    class="text-slate-200 font-semibold">{{ \Carbon\Carbon::parse($order->expires_at)->translatedFormat('d F Y, H:i') }}
                                    WIB</span></p>
                        </div>

                        {{-- Payment Info --}}
                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                                <h3 class="text-sm font-semibold text-slate-900">Metode Transfer</h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <p class="text-sm text-slate-500">Silakan transfer ke salah satu rekening di bawah ini:</p>

                                @forelse ($paymentMethods as $pm)
                                    <div
                                        class="flex items-start justify-between p-4 border border-slate-200 rounded-md bg-white hover:border-slate-300 transition-colors">
                                        <div class="flex gap-4">
                                            @if ($pm->logo)
                                                <div
                                                    class="w-12 h-12 rounded-md bg-slate-50 flex-shrink-0 border border-slate-100 overflow-hidden">
                                                    <img src="{{ asset('storage/' . $pm->logo) }}" alt="{{ $pm->name }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-md bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100 flex-shrink-0">
                                                    <i class="fas fa-wallet text-xl"></i>
                                                </div>
                                            @endif
                                            <div class="space-y-1">
                                                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                                    {{ $pm->name }}</div>
                                                <div class="text-lg font-bold text-slate-900 font-mono">
                                                    {{ $pm->account_number }}</div>
                                                <div class="text-xs font-medium text-slate-500">a.n
                                                    {{ $pm->account_holder }}</div>
                                                @if ($pm->description)
                                                    <p class="text-[10px] text-slate-400 mt-1 italic">{{ $pm->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <button onclick="copyToClipboard('{{ $pm->account_number }}')"
                                            class="p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-md transition-all group"
                                            title="Salin Nomor">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                @empty
                                    <div
                                        class="text-center py-6 bg-slate-50 rounded-lg border border-dashed border-slate-200">
                                        <p class="text-slate-400 text-sm">Belum ada metode pembayaran yang tersedia.</p>
                                        <p class="text-xs text-slate-400 mt-1">Silakan hubungi admin.</p>
                                    </div>
                                @endforelse

                                <div class="bg-blue-50 border border-blue-100 rounded-md p-4 flex gap-3">
                                    <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs text-blue-800 leading-relaxed font-medium">
                                        Penting: Pastikan nominal transfer sesuai dengan total tagihan agar verifikasi
                                        berjalan cepat. Setelah transfer, upload bukti pembayaran di formulir samping.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Total & Upload (5/12) --}}
                    <div class="lg:col-span-5 space-y-6">
                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                            <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Total Tagihan
                            </h3>
                            <div class="text-3xl font-bold text-slate-900 font-mono">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                                <h3 class="text-sm font-semibold text-slate-900">Upload Bukti Pembayaran</h3>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('merchandise.upload_proof', $order->transaction_id) }}"
                                    method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf

                                    <div class="space-y-2">
                                        @if ($order->status == 'cancelled')
                                            <div
                                                class="w-full aspect-video rounded-lg border-2 border-dashed border-rose-200 bg-rose-50 flex flex-col items-center justify-center p-6 text-center">
                                                <svg class="w-8 h-8 text-rose-400 mb-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                                <p class="text-sm font-medium text-rose-600">Pesanan Dibatalkan</p>
                                                <p class="text-xs text-rose-500 mt-1">Anda tidak dapat mengupload bukti
                                                    untuk pesanan ini.</p>
                                            </div>
                                        @else
                                            <div class="relative w-full aspect-video">
                                                <div class="absolute inset-0">
                                                    <label for="payment_proof"
                                                        class="flex flex-col items-center justify-center w-full h-full border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-slate-400 transition-all group overflow-hidden">
                                                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center z-10"
                                                            id="upload_placeholder">
                                                            <div
                                                                class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center mb-3 group-hover:bg-white group-hover:text-slate-900 shadow-sm transition-all">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <p class="text-sm font-medium text-slate-700">Klik untuk upload
                                                                bukti</p>
                                                            <p class="text-xs text-slate-500 mt-1">PNG, JPG, JPEG (Max.
                                                                2MB)</p>
                                                        </div>
                                                        <img id="image_preview"
                                                            class="absolute inset-0 w-full h-full object-contain bg-white rounded-lg hidden border-2 border-slate-200">
                                                        <input id="payment_proof" name="payment_proof" type="file"
                                                            class="hidden" accept="image/*" required />
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <button type="submit" @disabled($order->status == 'cancelled')
                                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 disabled:bg-slate-300 disabled:cursor-not-allowed transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $order->status == 'cancelled' ? 'Pesanan Dibatalkan' : 'Konfirmasi Pembayaran' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Countdown Logic
        const expireDateStr = "{{ \Carbon\Carbon::parse($order->expires_at)->toIso8601String() }}";
        const expireTime = new Date(expireDateStr).getTime();
        const countdownElement = document.getElementById('countdown');

        function updateTimer() {
            const now = new Date().getTime();
            const distance = expireTime - now;

            if (distance < 0) {
                countdownElement.innerHTML = "00:00:00";
                countdownElement.classList.add('text-rose-400');
                if (!countdownElement.dataset.expired) {
                    countdownElement.dataset.expired = "true";
                }
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const display =
                (hours < 10 ? "0" + hours : hours) + ":" +
                (minutes < 10 ? "0" + minutes : minutes) + ":" +
                (seconds < 10 ? "0" + seconds : seconds);

            countdownElement.innerHTML = display;
        }

        if (countdownElement) {
            setInterval(updateTimer, 1000);
            updateTimer();
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil disalin!',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        }

        const proofInput = document.getElementById('payment_proof');
        const imagePreview = document.getElementById('image_preview');
        const uploadPlaceholder = document.getElementById('upload_placeholder');

        if (proofInput) {
            proofInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        uploadPlaceholder.classList.add('opacity-0', 'absolute');
                        uploadPlaceholder.classList.remove('flex');
                        uploadPlaceholder.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
@endsection
