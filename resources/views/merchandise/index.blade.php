@extends('layouts.app')

@section('title', 'Merchandise - HMIF ITATS')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center space-y-4 mb-12">
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl">
                    Merchandise <span class="text-primary italic">HMIF ITATS</span>
                </h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Dapatkan merchandise eksklusif HMIF ITATS. Tunjukkan kebanggaanmu sebagai bagian dari keluarga besar
                    Informatika!
                </p>
            </div>

            @if ($merchandises->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($merchandises as $m)
                        <div
                            class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                            <!-- Image -->
                            <div class="aspect-square relative overflow-hidden bg-slate-100">
                                @if ($m->image)
                                    <img src="{{ asset('storage/' . $m->image) }}" alt="{{ $m->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i class="fas fa-tshirt text-6xl"></i>
                                    </div>
                                @endif

                                <!-- Stock Badge -->
                                @if ($m->stock <= 5)
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="px-3 py-1 bg-rose-600 text-white rounded-full text-[10px] font-bold uppercase tracking-widest shadow-lg">
                                            Stok Terbatas!
                                        </span>
                                    </div>
                                @endif

                                <!-- Category Badge -->
                                @if ($m->category)
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="px-3 py-1 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold text-slate-900 uppercase tracking-widest shadow-sm">
                                            {{ $m->category }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex flex-col flex-1">
                                <h3
                                    class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary transition-colors">
                                    {{ $m->name }}
                                </h3>

                                <p class="text-slate-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($m->description, 80) }}
                                </p>

                                <!-- Sizes -->
                                @if ($m->sizes && count($m->sizes) > 0)
                                    <div class="mb-4">
                                        <p class="text-xs font-semibold text-slate-500 mb-2">Ukuran:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($m->sizes as $size)
                                                <span
                                                    class="px-2 py-1 bg-slate-100 text-slate-700 rounded text-xs font-medium">{{ $size }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Price & Stock -->
                                <div class="mt-auto pt-4 border-t border-slate-100">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">Harga</p>
                                            <p class="text-2xl font-bold text-primary">Rp
                                                {{ number_format($m->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-slate-500 mb-1">Stok</p>
                                            <p class="text-lg font-bold text-slate-900">{{ $m->stock }} unit</p>
                                        </div>
                                    </div>

                                    <a href="{{ route('merchandise.show', $m->slug) }}"
                                        class="block w-full py-3 bg-slate-900 text-white text-center rounded-lg font-bold text-sm hover:bg-slate-800 transition-colors shadow-lg hover:shadow-xl">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tshirt text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Produk</h3>
                    <p class="text-slate-500">Merchandise akan segera tersedia!</p>
                </div>
            @endif
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        </script>
    @endif
@endsection
