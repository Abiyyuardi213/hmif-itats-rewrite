@extends('layouts.app')

@section('content')
    <main class="min-h-screen bg-background">

        {{-- Hero Section (from HeroKegiatan) --}}
        <section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
            <div class="container mx-auto">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="mb-8 float-animation">
                        <div class="w-32 h-32 mx-auto mb-8 relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-primary/20 to-accent/20 rounded-full blur-xl">
                            </div>
                            <div
                                class="relative w-full h-full bg-card border-2 border-primary/20 rounded-full flex items-center justify-center glow-animation shadow-lg">
                                <span class="text-4xl font-bold text-primary">HMIF</span>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-balance mb-6">
                        Recap Kegiatan
                        <br />
                        <span class="text-primary">Himpunan Mahasiswa</span>
                    </h1>

                    <p class="text-lg sm:text-xl text-muted-foreground text-balance max-w-2xl mx-auto mb-8 leading-relaxed">
                        Dokumentasi lengkap program kerja dan kegiatan yang telah berhasil dilaksanakan oleh Himpunan
                        Mahasiswa
                        Teknik Informatika ITATS
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <div class="text-sm text-muted-foreground">PERIODE 2024 • TEKNIK INFORMATIKA • ITATS</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Stats Section (from StatsSection) --}}
        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-muted/30">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $statItems = [
                            [
                                'number' => $stats['completedPrograms'],
                                'label' => 'Program Kerja Selesai',
                                'description' => 'Berbagai kegiatan akademik dan non-akademik',
                            ],
                            [
                                'number' => $stats['totalParticipants'] . '+',
                                'label' => 'Mahasiswa Terlibat',
                                'description' => 'Partisipasi aktif dari seluruh angkatan',
                            ],
                            [
                                'number' => $stats['partners'],
                                'label' => 'Mitra Kerjasama',
                                'description' => 'Kolaborasi dengan industri dan institusi',
                            ],
                            [
                                'number' => $stats['activeMonths'],
                                'label' => 'Bulan Aktif',
                                'description' => 'Konsistensi kegiatan sepanjang tahun',
                            ],
                        ];
                    @endphp

                    @foreach ($statItems as $stat)
                        <div
                            class="p-6 text-center hover:shadow-lg transition-all duration-300 rounded-xl bg-card border border-border">
                            <div class="text-3xl sm:text-4xl font-bold text-primary mb-2">{{ $stat['number'] }}</div>
                            <div class="text-sm font-semibold text-foreground mb-2">{{ $stat['label'] }}</div>
                            <div class="text-xs text-muted-foreground leading-relaxed">{{ $stat['description'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Aktivitas Grid (from AktivitasGrid) --}}
        <section id="kegiatan" class="py-16 px-4 sm:px-6 lg:px-8">
            <div class="container mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-balance mb-4">Program Kerja yang Telah Selesai</h2>
                    <p class="text-lg text-muted-foreground text-balance max-w-2xl mx-auto">
                        Berikut adalah dokumentasi lengkap kegiatan dan program kerja yang telah berhasil dilaksanakan
                    </p>
                </div>

                {{-- Activities List --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        function getCategoryClasses($category)
                        {
                            $colors = [
                                'AKADEMIK' => 'bg-blue-100 text-blue-800',
                                'KOMPETISI' => 'bg-red-100 text-red-800',
                                'PELATIHAN' => 'bg-green-100 text-green-800',
                                'SOSIAL' => 'bg-purple-100 text-purple-800',
                                'KUNJUNGAN' => 'bg-orange-100 text-orange-800',
                            ];
                            return $colors[$category] ?? 'bg-gray-100 text-gray-800';
                        }
                    @endphp

                    @if ($activities->isEmpty())
                        <div class="col-span-full text-center p-8 border rounded border-dashed text-muted-foreground">
                            <p>Belum ada data kegiatan.</p>
                        </div>
                    @endif

                    @foreach ($activities as $activity)
                        <a href="/kegiatan/{{ $activity['slug'] }}" class="block group">
                            <div
                                class="overflow-hidden rounded-xl border border-border bg-card text-card-foreground shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer h-full flex flex-col">
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ $activity['image'] ?? asset('placeholder.svg') }}"
                                        alt="{{ $activity['title'] }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        onerror="this.src='https://placehold.co/600x400?text=No+Image'" />
                                </div>

                                <div class="p-6 flex-1 flex flex-col">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent {{ getCategoryClasses($activity['category']) }}">
                                            {{ $activity['category'] }}
                                        </span>
                                        <span class="text-xs text-muted-foreground">
                                            {{ \Carbon\Carbon::parse($activity['date'])->translatedFormat('F Y') }}
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-semibold text-foreground mb-2 text-balance">
                                        {{ $activity['title'] }}</h3>

                                    <p class="text-sm text-muted-foreground mb-4 leading-relaxed line-clamp-3">
                                        {{ $activity['description'] }}
                                    </p>

                                    <div
                                        class="mt-auto flex items-center justify-between text-xs text-muted-foreground pt-4 border-t border-border">
                                        <span>
                                            {{ $activity['participants_count'] ?? 0 }} peserta
                                        </span>
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-green-600 border-green-200">
                                            ✓
                                            {{ $activity['status'] === 'completed'
                                                ? 'Selesai'
                                                : ($activity['status'] === 'ongoing'
                                                    ? 'Berlangsung'
                                                    : ($activity['status'] === 'upcoming'
                                                        ? 'Akan Datang'
                                                        : $activity['status'])) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- CTA Section --}}
                <div class="text-center mt-12">
                    <p class="text-muted-foreground mb-6">
                        Ingin melihat Program kerja lainnya atau melihat pengumuman mendatang?
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="/program-kerja"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-6 py-3">
                            Lihat Program Kerja
                        </a>
                        <a href="/pengumuman"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-6 py-3">
                            Lihat Pengumuman
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
