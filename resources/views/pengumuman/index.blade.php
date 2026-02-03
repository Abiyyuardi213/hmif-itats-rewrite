@extends('layouts.app')

@section('title', 'Pengumuman - HMIF ITATS')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center space-y-4 mb-12">
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl">
                    Pengumuman <span class="text-primary italic">Terbaru</span>
                </h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Dapatkan informasi terkini seputar kegiatan, berita, dan pengumuman penting dari Himpunan Mahasiswa
                    Informatika ITATS.
                </p>
            </div>

            @if ($announcements->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($announcements as $a)
                        <article
                            class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                            <!-- Image Container -->
                            <div class="aspect-video relative overflow-hidden bg-slate-100">
                                @if ($a->image)
                                    <img src="{{ asset('storage/' . $a->image) }}" alt="{{ $a->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i class="fas fa-bullhorn text-4xl"></i>
                                    </div>
                                @endif
                                <!-- Date Badge -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold text-slate-900 uppercase tracking-widest shadow-sm">
                                        {{ $a->published_at ? $a->published_at->format('d M Y') : $a->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex flex-col flex-1">
                                <h2
                                    class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2 leading-tight">
                                    {{ $a->title }}
                                </h2>
                                <div
                                    class="text-slate-600 text-sm mb-6 line-clamp-3 leading-relaxed prose prose-sm max-w-none">
                                    {!! Str::limit($a->content, 150) !!}
                                </div>

                                <div class="mt-auto pt-4 border-t border-slate-50">
                                    <a href="{{ route('pengumuman.show', $a->slug) }}"
                                        class="inline-flex items-center text-sm font-bold text-primary group-hover:gap-2 transition-all">
                                        Baca Selengkapnya
                                        <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $announcements->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bullhorn text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pengumuman</h3>
                    <p class="text-slate-500">Nantikan informasi menarik lainnya segera!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
