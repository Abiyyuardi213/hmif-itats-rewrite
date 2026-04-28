@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white" x-data="{ selectedDivision: null }">
        {{-- Header Section --}}
        <section class="relative overflow-hidden bg-slate-50 py-12 md:py-16 border-b border-slate-200">
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
        <section class="py-20 px-6 bg-white relative overflow-hidden">
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-primary/5 rounded-full blur-[120px] -z-10">
            </div>

            <div class="container mx-auto max-w-7xl">
                <div class="text-center space-y-4 mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tighter">Pengurus Inti</h2>
                    <p class="text-slate-500 max-w-2xl mx-auto font-medium text-sm">Pemimpin dan penggerak utama organisasi HMIF
                        ITATS periode 2024/2025.</p>
                    <div class="w-16 h-1 bg-primary mx-auto rounded-full"></div>
                </div>

                @if ($pengurusInti->count() > 0)
                    @php
                        // Logic to find specific roles for Pengurus Inti
                        $ketua = $pengurusInti
                            ->filter(
                                fn($m) => str_contains(strtolower($m->position->name), 'ketua') &&
                                    !str_contains(strtolower($m->position->name), 'wakil'),
                            )
                            ->first();
                        $wakil = $pengurusInti
                            ->filter(fn($m) => str_contains(strtolower($m->position->name), 'wakil'))
                            ->first();
                        $sekretaris = $pengurusInti
                            ->filter(fn($m) => str_contains(strtolower($m->position->name), 'sekretaris'))
                            ->values();
                        $bendahara = $pengurusInti
                            ->filter(fn($m) => str_contains(strtolower($m->position->name), 'bendahara'))
                            ->values();

                        // Remaining inti members who are not specifically handled
                        $others = $pengurusInti->filter(function ($m) use ($ketua, $wakil, $sekretaris, $bendahara) {
                            $handledIds = collect([$ketua?->id, $wakil?->id])
                                ->merge($sekretaris->pluck('id'))
                                ->merge($bendahara->pluck('id'));
                            return !$handledIds->contains($m->id);
                        });
                    @endphp

                    <div class="flex flex-col gap-16">
                        {{-- Top: Ketua Himpunan --}}
                        @if ($ketua)
                            <div class="flex justify-center">
                                <div class="w-full max-w-sm">
                                    <x-premium-member-card :member="$ketua" />
                                </div>
                            </div>
                        @endif

                        {{-- Middle: Wakil, Sekretaris, Bendahara --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                            @if ($wakil)
                                <x-premium-member-card :member="$wakil" />
                            @endif

                            @foreach ($sekretaris as $sekre)
                                <x-premium-member-card :member="$sekre" />
                            @endforeach

                            @foreach ($bendahara as $bend)
                                <x-premium-member-card :member="$bend" />
                            @endforeach

                            {{-- Fallback for others if any --}}
                            @foreach ($others as $other)
                                <x-premium-member-card :member="$other" />
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-20 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem]">
                        <p class="text-slate-400 font-medium italic">Data Pengurus Inti belum tersedia.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- Divisions Section --}}
        @foreach ($divisions as $division)
            <section class="py-16 px-6 {{ $loop->even ? 'bg-slate-50' : 'bg-white' }}">
                <div class="container mx-auto max-w-7xl">
                    {{-- Division Header --}}
                    <div class="text-center space-y-4 mb-12">
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-primary/10 border border-primary/20 px-4 py-1 text-xs font-bold text-primary uppercase tracking-widest">
                            Divisi {{ $loop->iteration }}
                        </span>
                        <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tighter">
                            {{ $division->name }}</h2>
                        <p class="text-slate-500 max-w-2xl mx-auto font-medium text-sm leading-relaxed">
                            {{ $division->description ?? 'Unit pelaksana yang membidangi aspek spesifik pengembangan organisasi.' }}
                        </p>
                        <div class="w-16 h-1 bg-primary mx-auto rounded-full"></div>
                    </div>

                    @php
                        // Logic for division members
                        $koordinator = $division->members
                            ->filter(function ($m) {
                                $p = strtolower($m->position->name);
                                return str_contains($p, 'koordinator') || str_contains($p, 'ketua');
                            })
                            ->first();

                        $staff = $division->members->filter(fn($m) => $m->id !== $koordinator?->id);
                    @endphp

                    <div class="space-y-12">
                        {{-- Koordinator Divisi --}}
                        @if ($koordinator)
                            <div class="flex justify-center">
                                <div class="w-full max-w-sm">
                                    <x-premium-member-card :member="$koordinator" />
                                </div>
                            </div>
                        @endif

                        {{-- Staff Grid --}}
                        @if ($staff->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                                @foreach ($staff as $member)
                                    <x-premium-member-card :member="$member" />
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach

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
