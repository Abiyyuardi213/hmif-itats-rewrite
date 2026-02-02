@extends('layouts.app')

@section('title', 'Struktur Organisasi - HMIF ITATS')

@section('content')
    <!-- Hero Section -->
    <section class="py-12 md:py-16 bg-slate-50 border-b border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-50 border border-pink-100 mb-8">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                <span class="text-sm font-bold text-primary">Kepengurusan & Divisi</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-4 tracking-tight">
                Struktur Organisasi <br>
                <span class="text-primary">HMIF ITATS</span>
            </h1>

            <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Mengenal lebih dekat para pengurus dan divisi yang berdedikasi untuk kemajuan Himpunan Mahasiswa Informatika
            </p>
        </div>
    </section>

    <!-- Pengurus Inti Section -->
    @if ($pengurusInti->count() > 0)
        <section class="py-16 md:py-24 bg-white overflow-hidden">
            <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight uppercase">Pengurus Inti</h2>
                    <div class="w-20 h-1.5 bg-primary mx-auto rounded-full shadow-sm shadow-primary/20"></div>
                </div>

                <div class="flex flex-col items-center gap-12 lg:gap-16">
                    @php
                        $ketua = $pengurusInti
                            ->filter(function ($m) {
                                return Str::contains(Str::lower($m->position->name), 'ketua');
                            })
                            ->first();
                        $others = $pengurusInti->reject(function ($m) use ($ketua) {
                            return $ketua && $m->id == $ketua->id;
                        });
                    @endphp

                    <!-- Ketua Himpunan / Leader -->
                    @if ($ketua)
                        <div class="w-full max-w-sm">
                            <div
                                class="group relative bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm hover:shadow-2xl transition-all duration-500 text-center">
                                <div class="absolute -top-12 left-1/2 -translate-x-1/2">
                                    <div
                                        class="w-24 h-24 rounded-3xl bg-slate-900 overflow-hidden shadow-2xl rotate-3 group-hover:rotate-0 transition-transform duration-500 ring-4 ring-white">
                                        <img src="{{ $ketua->image ? asset('storage/' . $ketua->image) : 'https://api.luckysf.com/api/placeholder/400/400' }}"
                                            alt="{{ $ketua->name }}" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="mt-12">
                                    <h3 class="text-xl font-black text-slate-900 mb-0">{{ $ketua->name }}</h3>
                                    <p class="text-[10px] text-slate-400 font-bold mb-1">{{ $ketua->npm ?? 'NPM N/A' }}</p>
                                    <span
                                        class="text-primary font-bold uppercase tracking-widest text-xs">{{ $ketua->position->name }}</span>
                                    <div class="mt-6 pt-6 border-t border-slate-100 flex justify-center gap-4">
                                        @if ($ketua->instagram_url)
                                            <a href="{{ $ketua->instagram_url }}" target="_blank"
                                                class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all"><span
                                                    class="text-[10px] font-bold">IG</span></a>
                                        @endif
                                        @if ($ketua->linkedin_url)
                                            <a href="{{ $ketua->linkedin_url }}" target="_blank"
                                                class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all"><span
                                                    class="text-[10px] font-bold">LI</span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Other Core Members -->
                    @if ($others->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 w-full max-w-6xl px-4">
                            @foreach ($others as $other)
                                <div
                                    class="group relative bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm hover:shadow-2xl transition-all duration-500 text-center">
                                    <div class="absolute -top-10 left-1/2 -translate-x-1/2">
                                        <div
                                            class="w-20 h-20 rounded-3xl bg-slate-800 overflow-hidden shadow-xl {{ $loop->even ? 'rotate-6' : '-rotate-6' }} group-hover:rotate-0 transition-transform duration-500 ring-4 ring-white">
                                            <img src="{{ $other->image ? asset('storage/' . $other->image) : 'https://api.luckysf.com/api/placeholder/400/400' }}"
                                                alt="{{ $other->name }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                    <div class="mt-10">
                                        <h3 class="text-lg font-black text-slate-900 mb-0">{{ $other->name }}</h3>
                                        <p class="text-[10px] text-slate-400 font-bold mb-1">{{ $other->npm ?? 'NPM N/A' }}
                                        </p>
                                        <span
                                            class="text-primary font-bold uppercase tracking-widest text-xs">{{ $other->position->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Divisions Grid -->
    @if ($divisions->count() > 0)
        <section class="py-16 md:py-24 bg-slate-50/50 border-y border-slate-100">
            <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight uppercase">Divisi Organisasi</h2>
                    <div class="w-20 h-1.5 bg-primary mx-auto rounded-full shadow-sm shadow-primary/20"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                    @foreach ($divisions as $division)
                        @php
                            $koordinator =
                                $division->members
                                    ->filter(function ($m) {
                                        return Str::contains(Str::lower($m->position->name), 'koordinator');
                                    })
                                    ->first() ?? $division->members->first();
                            $otherMembers = $division->members->reject(function ($m) use ($koordinator) {
                                return $koordinator && $m->id == $koordinator->id;
                            });
                            $divId = Str::slug($division->name);
                        @endphp
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 p-6 md:p-8 flex flex-col h-full"
                            id="divisi-{{ $divId }}">
                            <div class="flex justify-between items-start mb-6">
                                <div
                                    class="w-12 h-12 {{ $division->color ?? 'bg-primary' }} rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-bold border border-amber-200">{{ $division->members->count() }}
                                    Anggota</span>
                            </div>

                            <h3 class="text-2xl font-black text-slate-900 mb-2">Divisi {{ $division->name }}</h3>
                            <p class="text-slate-500 text-xs mb-4 line-clamp-2">{{ $division->description }}</p>

                            @if ($koordinator)
                                <!-- Coordinator -->
                                <div
                                    class="bg-slate-50 rounded-xl p-4 border border-slate-100 mb-6 flex items-center gap-4 mt-2">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary overflow-hidden flex items-center justify-center text-white font-black text-sm">
                                        @if ($koordinator->image)
                                            <img src="{{ asset('storage/' . $koordinator->image) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($koordinator->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm italic">{{ $koordinator->name }}</h4>
                                        <p class="text-[9px] text-slate-400 font-bold -mt-1 mb-1">
                                            {{ $koordinator->npm ?? 'NPM N/A' }}</p>
                                        <span
                                            class="text-[10px] px-2 py-0.5 rounded bg-pink-100 text-primary font-bold uppercase">{{ $koordinator->position->name }}</span>
                                    </div>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                @foreach ($otherMembers->take(4) as $member)
                                    <div class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                        <div
                                            class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                            @if ($member->image)
                                                <img src="{{ asset('storage/' . $member->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($member->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 truncate max-w-[100px]">
                                                {{ $member->name }}</p>
                                            <p class="text-[9px] text-slate-400 font-bold">{{ $member->npm ?? 'NPM N/A' }}
                                            </p>
                                            <p class="text-xs text-slate-400">{{ $member->position->name }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                @if ($otherMembers->count() > 4)
                                    <div class="hidden-members hidden contents">
                                        @foreach ($otherMembers->skip(4) as $member)
                                            <div
                                                class="flex gap-3 items-start p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden flex items-center justify-center text-slate-500 text-xs font-bold shrink-0">
                                                    @if ($member->image)
                                                        <img src="{{ asset('storage/' . $member->image) }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        {{ strtoupper(substr($member->name, 0, 2)) }}
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-slate-900 truncate max-w-[100px]">
                                                        {{ $member->name }}</p>
                                                    <p class="text-[9px] text-slate-400 font-bold">
                                                        {{ $member->npm ?? 'NPM N/A' }}</p>
                                                    <p class="text-xs text-slate-400">{{ $member->position->name }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            @if ($otherMembers->count() > 4)
                                <div class="mt-auto pt-6 text-center border-t border-slate-100">
                                    <button onclick="toggleMembers(this, 'divisi-{{ $divId }}')"
                                        class="text-xs font-black text-primary hover:text-primary/70 transition-colors uppercase tracking-widest">
                                        Lihat Semua Anggota
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Join Section -->
    <section class="py-20 bg-white">
        <!-- ... (Join section remains same) ... -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight uppercase">Bergabung dengan Kami</h2>
            <p class="text-slate-500 font-medium mb-10 leading-relaxed">
                Tertarik untuk berkontribusi dan berkembang bersama dalam organisasi? Jangan ragu untuk menghubungi kami.
            </p>
            <div
                class="flex flex-col md:flex-row justify-center items-center gap-8 text-sm font-bold text-slate-400 uppercase tracking-widest">
                <a href="#" class="hover:text-primary transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    hmifitats1991@gmail.com
                </a>
                <span class="hidden md:inline text-slate-200">|</span>
                <a href="#" class="hover:text-primary transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7 10a2 2 0 11-4 0 2 2 0 014 0zM21 10a2 2 0 11-4 0 2 2 0 014 0zM17 21v-2a4 4 0 00-4-4H11a4 4 0 00-4 4v2">
                        </path>
                    </svg>
                    @hmif_itats
                </a>
            </div>
        </div>
    </section>

    <script>
        function toggleMembers(button, cardId) {
            const card = document.getElementById(cardId);
            const hiddenMembers = card.querySelector('.hidden-members');

            if (hiddenMembers.classList.contains('hidden')) {
                hiddenMembers.classList.remove('hidden');
                button.innerText = 'Tutup Detail';
            } else {
                hiddenMembers.classList.add('hidden');
                button.innerText = 'Lihat Semua Anggota';
            }
        }
    </script>
@endsection
