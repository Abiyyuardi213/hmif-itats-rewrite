@extends('layouts.app')

@section('title', $announcement->title . ' - HMIF ITATS')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-24 pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <a href="{{ route('pengumuman.index') }}"
                class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-primary transition-colors mb-6 group">
                <i class="fas fa-arrow-left mr-2 text-xs group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Pengumuman
            </a>

            <!-- Article -->
            <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-lg">
                <!-- Featured Image -->
                @if ($announcement->image)
                    <div class="aspect-video w-full overflow-hidden bg-slate-100">
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Content -->
                <div class="p-8 md:p-12">
                    <!-- Meta -->
                    <div class="flex items-center gap-4 mb-6 text-sm text-slate-500">
                        <span class="inline-flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-xs"></i>
                            {{ $announcement->published_at ? $announcement->published_at->format('d F Y') : $announcement->created_at->format('d F Y') }}
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <i class="fas fa-clock text-xs"></i>
                            {{ $announcement->published_at ? $announcement->published_at->format('H:i') : $announcement->created_at->format('H:i') }}
                            WIB
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-8 leading-tight">
                        {{ $announcement->title }}
                    </h1>

                    <!-- Content Body -->
                    <div class="prose prose-slate prose-lg max-w-none">
                        {!! $announcement->content !!}
                    </div>

                    <!-- Share Section -->
                    <div class="mt-12 pt-8 border-t border-slate-200">
                        <p class="text-sm font-semibold text-slate-700 mb-3">Bagikan Pengumuman:</p>
                        <div class="flex items-center gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($announcement->title) }}"
                                target="_blank"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-sky-500 text-white hover:bg-sky-600 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($announcement->title . ' - ' . request()->fullUrl()) }}"
                                target="_blank"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-green-600 text-white hover:bg-green-700 transition-colors">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <button onclick="copyLink()"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-200 text-slate-700 hover:bg-slate-300 transition-colors">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <script>
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Link berhasil disalin!');
            });
        }
    </script>
@endsection
