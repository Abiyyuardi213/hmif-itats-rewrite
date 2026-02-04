@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white" x-data="{ selectedDivision: null }">
        {{-- Header Section --}}
        <section class="relative overflow-hidden bg-slate-50 py-16 md:py-24 border-b border-slate-200">
            {{-- Grid Pattern Background --}}
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]">
            </div>

            <div class="relative container mx-auto px-6 text-center">
                <div class="max-w-4xl mx-auto space-y-6">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-pink-200 bg-pink-50 px-3 py-1 text-xs font-medium text-[#EB329A]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Struktur Organisasi
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 leading-tight">
                        Fungsionaris HMIF <br class="hidden sm:block" />
                        <span class="text-[#EB329A]">ITATS</span>
                    </h1>
                    <p class="text-lg text-slate-600 max-w-2xl mx-auto text-balance">
                        Mengenal lebih dekat dengan para pengurus yang berdedikasi untuk kemajuan organisasi mahasiswa
                        Informatika.
                    </p>
                </div>
            </div>
        </section>

        {{-- Pengurus Inti Section --}}
        <section class="py-16 px-6">
            <div class="container mx-auto max-w-7xl space-y-12">
                @if ($pengurusInti->count() > 0)
                    <div class="flex flex-col items-center space-y-12">
                        <div class="text-center space-y-2">
                            <h2 class="text-2xl font-bold text-slate-900">Pengurus Inti</h2>
                            <div class="w-16 h-1 bg-[#EB329A] mx-auto rounded-full"></div>
                        </div>

                        {{-- Determine Grid based on count to center nicely --}}
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full justify-center">
                            @foreach ($pengurusInti as $member)
                                @include('components.member-card', ['member' => $member])
                            @endforeach
                        </div>
                    </div>

                    {{-- Connection Line --}}
                    <div class="flex justify-center my-8">
                        <div class="w-px h-16 bg-gradient-to-b from-slate-200 to-transparent"></div>
                    </div>
                @else
                    <div class="text-center py-10 bg-slate-50 border border-dashed border-slate-300 rounded-lg">
                        <p class="text-slate-500">Data Pengurus Inti belum tersedia.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- Divisions Section --}}
        <section class="py-16 px-6 bg-slate-50/50">
            <div class="container mx-auto max-w-7xl">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Divisi Himpunan</h2>
                    <p class="text-slate-500">
                        Unit - unit pelaksana yang membidangi aspek spesifik dalam pengembangan organisasi dan mahasiswa.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach ($divisions as $division)
                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm transition-all duration-300 hover:shadow-md cursor-pointer group"
                            @click="selectedDivision = selectedDivision === '{{ $division->id }}' ? null : '{{ $division->id }}'">
                            <div class="p-6 space-y-6">
                                {{-- Division Header --}}
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        {{-- Icon Container based on division name or generic --}}
                                        <div
                                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-[#EC4899] flex items-center justify-center shadow-lg shadow-pink-500/20 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg>
                                        </div>
                                        <span
                                            class="inline-flex items-center rounded-full border border-slate-200 bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            {{ $division->members->count() }} Anggota
                                        </span>
                                    </div>
                                    <div>
                                        <h3
                                            class="text-xl font-bold text-slate-900 group-hover:text-[#EB329A] transition-colors">
                                            {{ $division->name }}
                                        </h3>
                                        <p class="text-sm text-slate-500 mt-2 line-clamp-2">
                                            {{ $division->description ?? 'Deskripsi divisi belum ditambahkan.' }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Members Section --}}
                                <div class="space-y-4">
                                    {{-- Find Coordinators --}}
                                    @php
                                        // Simple logic using 'Koordinator' or 'Ketua' in position name
                                        $coordinators = $division->members->filter(function ($m) {
                                            return stripos($m->position->name, 'Koordinator') !== false ||
                                                stripos($m->position->name, 'Ketua') !== false;
                                        });

                                        $members = $division->members->filter(function ($m) use ($coordinators) {
                                            return !$coordinators->contains('id', $m->id);
                                        });
                                    @endphp

                                    {{-- Coordinators Display --}}
                                    @foreach ($coordinators as $coord)
                                        <div
                                            class="flex items-center gap-4 p-4 rounded-lg bg-pink-50 border border-pink-100">
                                            <div class="relative">
                                                <div
                                                    class="h-12 w-12 rounded-full border-2 border-white shadow-sm overflow-hidden bg-white">
                                                    @if ($coord->image)
                                                        <img src="{{ asset('storage/' . $coord->image) }}"
                                                            alt="{{ $coord->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div
                                                            class="w-full h-full flex items-center justify-center bg-pink-100 text-[#EB329A] font-bold text-sm">
                                                            {{ substr($coord->name, 0, 2) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div
                                                    class="absolute -top-1 -right-1 w-5 h-5 bg-[#EB329A] rounded-full flex items-center justify-center border border-white">
                                                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <p class="font-semibold text-slate-900 truncate">{{ $coord->name }}</p>
                                                    <span
                                                        class="px-2 py-0.5 rounded text-[10px] font-bold bg-pink-100 text-[#EB329A] uppercase tracking-wide">
                                                        Koordinator
                                                    </span>
                                                </div>
                                                <p class="text-xs text-slate-500 truncate">{{ $coord->position->name }}</p>
                                                @if ($coord->npm)
                                                    <p class="text-[10px] text-slate-400 font-mono mt-0.5">
                                                        {{ $coord->npm }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Expandable Members Grid --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 transition-all duration-500 ease-in-out overflow-hidden"
                                        :class="selectedDivision === '{{ $division->id }}' ? 'max-h-[1000px] opacity-100' :
                                            'max-h-0 opacity-0'"
                                        x-cloak>
                                        @foreach ($members as $member)
                                            <div
                                                class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors border border-transparent hover:border-slate-200">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                                    @if ($member->image)
                                                        <img src="{{ asset('storage/' . $member->image) }}"
                                                            alt="{{ $member->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div
                                                            class="w-full h-full flex items-center justify-center text-slate-500 text-xs font-medium">
                                                            {{ substr($member->name, 0, 2) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-sm font-medium text-slate-900 truncate">
                                                        {{ $member->name }}</p>
                                                    <p class="text-xs text-slate-500 truncate">
                                                        {{ $member->position->name }}</p>
                                                    @if ($member->npm)
                                                        <p class="text-[10px] text-slate-400 font-mono mt-0.5">
                                                            {{ $member->npm }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Footer/Toggle --}}
                                    <div class="pt-2">
                                        <button
                                            class="w-full flex items-center justify-center gap-2 text-sm font-medium text-[#EB329A] hover:text-[#c91c7f] transition-colors py-2 rounded-lg hover:bg-pink-50/50">
                                            <span
                                                x-text="selectedDivision === '{{ $division->id }}' ? 'Sembunyikan Anggota' : 'Lihat ' + {{ $members->count() }} + ' Anggota Lainnya'"></span>
                                            <svg class="w-4 h-4 transition-transform duration-300"
                                                :class="selectedDivision === '{{ $division->id }}' ? 'rotate-180' : ''"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Join/CTA Footer --}}
        <section class="py-12 border-t border-slate-200 bg-white">
            <div class="container mx-auto px-6 text-center space-y-6">
                <h3 class="text-xl font-semibold text-slate-900">Ingin menjadi bagian dari kami?</h3>
                <p class="text-slate-500 max-w-lg mx-auto">
                    Nantikan masa open recruitment anggota baru HMIF ITATS. Pantau terus informasi terbaru di sosial media
                    kami.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="https://www.instagram.com/hmif_itats/" target="_blank"
                        class="inline-flex items-center gap-2 rounded-lg bg-pink-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.9c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                        Instagram
                    </a>
                </div>
            </div>
        </section>
    </div>

    {{-- Alpine.js for interactivity --}}
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
