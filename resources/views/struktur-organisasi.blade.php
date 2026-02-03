@extends('layouts.app')

@section('title', 'Struktur Organisasi - HMIF ITATS')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 md:py-28 bg-slate-50 border-b border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Badge -->
            <div
                class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-medium text-slate-800 mb-6 backdrop-blur-sm shadow-sm">
                <span class="mr-2 h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                Kepengurusan & Divisi
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-[1.1]">
                Struktur Organisasi <br>
                <span class="text-primary/80">HMIF ITATS</span>
            </h1>

            <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Mengenal lebih dekat para pengurus dan divisi yang berdedikasi untuk kemajuan Himpunan Mahasiswa Informatika
            </p>
        </div>
    </section>

    <!-- Pengurus Inti Section -->
    @if ($pengurusInti->count() > 0)
        <section class="py-24 bg-white overflow-hidden">
            <div class="max-w-[1400px] mx-auto px-6 sm:px-10 lg:px-12">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Pengurus Inti</h2>
                    <p class="text-slate-500 mt-2">Pilar utama pergerakan organisasi</p>
                </div>

                <div class="flex flex-col items-center gap-12 lg:gap-16">
                    @php
                        // First member in the ordered Inti collection is the leader
                        $ketua = $pengurusInti->first();
                        $others = $pengurusInti->skip(1);
                    @endphp

                    <!-- Ketua Himpunan / Leader -->
                    @if ($ketua)
                        <div class="w-full max-w-sm">
                            <div
                                class="p-8 rounded-2xl border border-slate-200 bg-white text-center shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="relative inline-block mb-6">
                                    <div
                                        class="w-24 h-24 rounded-full mx-auto overflow-hidden bg-slate-100 border-2 border-primary/20 p-1">
                                        <img src="{{ $ketua->image ? asset('storage/' . $ketua->image) : 'https://ui-avatars.com/api/?name=' . urlencode($ketua->name) . '&background=random' }}"
                                            alt="{{ $ketua->name }}" class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">
                                        {{ $ketua->position->name }}
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $ketua->name }}</h3>
                                <p class="text-sm font-medium text-slate-500 mb-1">{{ $ketua->position->name }}</p>
                                <p class="text-xs text-slate-400 mb-6">{{ $ketua->npm ?? 'NPM N/A' }}</p>

                                <div class="flex justify-center gap-3">
                                    @if ($ketua->instagram_url)
                                        <a href="{{ $ketua->instagram_url }}" target="_blank"
                                            class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary/10 hover:text-primary transition-all">
                                            <i class="fab fa-instagram text-sm"></i>
                                        </a>
                                    @endif
                                    @if ($ketua->linkedin_url)
                                        <a href="{{ $ketua->linkedin_url }}" target="_blank"
                                            class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary/10 hover:text-primary transition-all">
                                            <i class="fab fa-linkedin-in text-sm"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Other Core Members -->
                    @if ($others->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl">
                            @foreach ($others as $other)
                                <div
                                    class="p-6 rounded-2xl border border-slate-200 bg-white text-center shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <div
                                        class="w-20 h-20 rounded-full mx-auto mb-4 bg-slate-100 overflow-hidden border border-slate-200 p-0.5">
                                        <img src="{{ $other->image ? asset('storage/' . $other->image) : 'https://ui-avatars.com/api/?name=' . urlencode($other->name) . '&background=random' }}"
                                            alt="{{ $other->name }}" class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $other->name }}</h3>
                                    <p class="text-sm font-medium text-slate-500 mb-1">{{ $other->position->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $other->npm ?? 'NPM N/A' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        <section class="py-24 bg-white">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <div
                    class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-dashed border-slate-200 text-slate-300">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <p class="text-slate-400 italic font-medium">Data pengurus inti belum tersedia.</p>
            </div>
        </section>
    @endif

    <!-- Divisions Grid -->
    @if ($divisions->count() > 0)
        <section class="py-24 bg-slate-50/50 border-y border-slate-100">
            <div class="max-w-[1400px] mx-auto px-6 sm:px-10 lg:px-12">
                <div class="flex flex-col items-center justify-center text-center space-y-4 mb-16">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Divisi Organisasi</h2>
                    <p class="max-w-[700px] text-slate-500 md:text-lg">
                        Masing-masing divisi memiliki peran strategis dalam mewujudkan visi dan misi HMIF ITATS.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($divisions as $division)
                        @php
                            // The first member in the division is assumed to be the koordinator based on order
                            $koordinator = $division->members->first();
                            $otherMembers = $division->members->skip(1);
                            $divId = Str::slug($division->name);
                        @endphp
                        <div class="rounded-xl border border-slate-200 bg-white p-8 shadow-sm transition-shadow hover:shadow-md flex flex-col h-full"
                            id="divisi-{{ $divId }}">

                            <div class="flex justify-between items-start mb-6">
                                <div
                                    class="inline-flex h-12 w-12 items-center justify-center rounded-lg shadow-sm border {{ $division->color ?: 'bg-slate-100 text-primary border-slate-200' }}">
                                    <i class="fas {{ $division->icon ?: 'fa-users' }} text-xl"></i>
                                </div>
                                <div
                                    class="px-3 py-1 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                                    {{ $division->members->count() }} Anggota
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 mb-3">Divisi {{ $division->name }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-8 line-clamp-2">
                                {{ $division->description ?: 'Bertanggung jawab dalam mengelola program kerja yang berkaitan dengan ' . strtolower($division->name) . '.' }}
                            </p>

                            @if ($koordinator)
                                <!-- Coordinator -->
                                <div
                                    class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 mb-6 flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-white border border-slate-200 overflow-hidden shrink-0">
                                        @if ($koordinator->image)
                                            <img src="{{ asset('storage/' . $koordinator->image) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-primary/10 text-primary text-xs font-bold">
                                                {{ strtoupper(substr($koordinator->name, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-slate-900 text-sm truncate">{{ $koordinator->name }}</h4>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span
                                                class="text-[10px] bg-primary/10 text-primary font-bold px-1.5 py-0.5 rounded uppercase">{{ $koordinator->position->name }}</span>
                                            <span
                                                class="text-[10px] text-slate-400 font-medium">{{ $koordinator->npm ?? 'NPM N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-3 mb-8">
                                @foreach ($otherMembers->take(4) as $member)
                                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-colors">
                                        <div
                                            class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center text-slate-500 text-[10px] font-bold shrink-0">
                                            @if ($member->image)
                                                <img src="{{ asset('storage/' . $member->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($member->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-bold text-slate-900 truncate">{{ $member->name }}</p>
                                            <p class="text-[10px] text-slate-400">{{ $member->position->name }} •
                                                {{ $member->npm ?? 'NPM N/A' }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                @if ($otherMembers->count() > 4)
                                    <div class="hidden-members hidden space-y-3">
                                        @foreach ($otherMembers->skip(4) as $member)
                                            <div
                                                class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-colors">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center text-slate-500 text-[10px] font-bold shrink-0">
                                                    @if ($member->image)
                                                        <img src="{{ asset('storage/' . $member->image) }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        {{ strtoupper(substr($member->name, 0, 2)) }}
                                                    @endif
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-bold text-slate-900 truncate">
                                                        {{ $member->name }}</p>
                                                    <p class="text-[10px] text-slate-400">{{ $member->position->name }} •
                                                        {{ $member->npm ?? 'NPM N/A' }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            @if ($otherMembers->count() > 4)
                                <div class="mt-auto pt-6 border-t border-slate-100 text-center">
                                    <button onclick="toggleMembers(this, 'divisi-{{ $divId }}')"
                                        class="text-xs font-bold text-primary hover:text-primary/70 transition-colors uppercase tracking-widest inline-flex items-center gap-2">
                                        <span>Lihat Semua Anggota</span>
                                        <i class="fas fa-chevron-down text-[10px] transition-transform duration-300"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="py-24 bg-slate-50/50 border-y border-slate-100">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <div
                    class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 border border-dashed border-slate-200 text-slate-300">
                    <i class="fas fa-sitemap text-2xl"></i>
                </div>
                <p class="text-slate-400 italic font-medium">Data divisi belum tersedia.</p>
            </div>
        </section>
    @endif

    <!-- Join Section -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div
                class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10 text-primary mb-8 animate-bounce">
                <i class="fas fa-paper-plane text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">Bergabung dengan Kami</h2>
            <p class="text-slate-500 font-medium mb-12 leading-relaxed">
                Tertarik untuk berkontribusi dan berkembang bersama dalam organisasi? <br class="hidden md:block"> Jangan
                ragu untuk menghubungi kami melalui saluran resmi HMIF ITATS.
            </p>
            <div class="flex flex-col md:flex-row justify-center items-center gap-8 text-sm">
                <a href="mailto:hmifitats1991@gmail.com"
                    class="bg-slate-50 border border-slate-200 px-6 py-3 rounded-xl hover:border-primary/30 hover:bg-white transition-all group flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors shadow-sm">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <span class="font-bold text-slate-700 tracking-tight">hmifitats1991@gmail.com</span>
                </a>
                <a href="https://instagram.com/hmif_itats" target="_blank"
                    class="bg-slate-50 border border-slate-200 px-6 py-3 rounded-xl hover:border-primary/30 hover:bg-white transition-all group flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors shadow-sm">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <span class="font-bold text-slate-700 tracking-tight">@hmif_itats</span>
                </a>
            </div>
        </div>
    </section>

    <script>
        function toggleMembers(button, cardId) {
            const card = document.getElementById(cardId);
            const hiddenMembers = card.querySelector('.hidden-members');
            const icon = button.querySelector('i');
            const span = button.querySelector('span');

            if (hiddenMembers.classList.contains('hidden')) {
                hiddenMembers.classList.remove('hidden');
                span.innerText = 'Tutup Detail';
                icon.classList.add('rotate-180');
            } else {
                hiddenMembers.classList.add('hidden');
                span.innerText = 'Lihat Semua Anggota';
                icon.classList.remove('rotate-180');
            }
        }
    </script>
@endsection
