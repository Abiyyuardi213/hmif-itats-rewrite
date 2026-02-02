@extends('layouts.app')

@section('title', 'Program Kerja - HMIF ITATS')

@section('content')
    <div class="bg-slate-100 min-h-screen pb-20">
        <!-- Header -->
        <div class="bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Program Kerja</h1>
                        <p class="text-slate-500 mt-1 font-medium">Himpunan Mahasiswa Teknik Informatika ITATS</p>
                        <p
                            class="text-[10px] font-bold text-primary uppercase tracking-[0.2em] mt-2 bg-pink-50 inline-block px-3 py-1 rounded-full border border-pink-100 italic">
                            Periode 2025/2026</p>
                    </div>
                    <div class="text-right hidden md:block bg-slate-50 p-6 rounded-3xl border border-slate-100 shadow-sm">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Total
                            Program</span>
                        <span class="text-5xl font-black text-slate-900 tracking-tighter">{{ $programs->count() }}</span>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex flex-wrap gap-3">
                    <button
                        class="px-6 py-2.5 rounded-2xl bg-slate-900 text-white text-xs font-bold shadow-xl shadow-slate-900/20 transition-all hover:-translate-y-0.5"
                        onclick="filterPrograms('all')">
                        Semua Program
                    </button>
                    <button
                        class="px-6 py-2.5 rounded-2xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2"
                        onclick="filterPrograms('selesai')">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Selesai
                    </button>
                    <button
                        class="px-6 py-2.5 rounded-2xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2"
                        onclick="filterPrograms('berjalan')">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span> Sedang Berjalan
                    </button>
                    <button
                        class="px-6 py-2.5 rounded-2xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2"
                        onclick="filterPrograms('mendatang')">
                        <span class="w-2 h-2 rounded-full bg-slate-400 animate-pulse"></span> Akan Datang
                    </button>
                </div>
            </div>
        </div>

        <!-- Timeline Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="relative">
                <!-- Vertical Line -->
                <div
                    class="absolute left-6 md:left-8 top-0 bottom-0 w-1 bg-gradient-to-b from-slate-200 via-slate-200 to-transparent rounded-full">
                </div>

                <div class="space-y-16">
                    @forelse($programs as $program)
                        <div class="program-item relative pl-20 md:pl-28 transition-all duration-500 reveal-on-scroll"
                            data-status="{{ $program->status }}">
                            <!-- Icon/Marker -->
                            <div
                                class="absolute left-2.5 md:left-4 top-0 w-10 h-10 md:w-14 md:h-14 rounded-[1.2rem] bg-white border-4 border-slate-50 flex items-center justify-center shadow-xl z-10 
                                @if ($program->status == 'selesai') text-emerald-600 border-emerald-50 
                                @elseif($program->status == 'berjalan') text-blue-600 border-blue-50 
                                @else text-slate-400 border-slate-50 @endif">
                                @if ($program->status == 'selesai')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @elseif($program->status == 'berjalan')
                                    <svg class="w-6 h-6 animate-spin-slow" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Card -->
                            <div
                                class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-500 relative overflow-hidden group hover:-translate-y-1">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-8">
                                    <div class="flex-grow">
                                        <div class="flex items-center gap-3 mb-4">
                                            <span
                                                class="px-3 py-1 rounded-full @if ($program->status == 'selesai') bg-emerald-100 text-emerald-700 @elseif($program->status == 'berjalan') bg-blue-100 text-blue-700 @else bg-slate-100 text-slate-700 @endif text-[10px] font-black uppercase tracking-widest">
                                                {{ $program->status }}
                                            </span>
                                            <span
                                                class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $program->division->name ?? 'General' }}</span>
                                        </div>
                                        <h3
                                            class="text-2xl md:text-3xl font-black text-slate-900 mb-4 group-hover:text-primary transition-colors leading-tight">
                                            {{ $program->name }}
                                        </h3>
                                        <p class="text-slate-500 font-medium mb-8 line-clamp-2 leading-relaxed">
                                            {{ $program->description }}
                                        </p>

                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs font-bold uppercase tracking-widest text-slate-400">
                                            <div
                                                class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100">
                                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($program->start_date)->format('d M Y') }}
                                            </div>
                                            <div
                                                class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100">
                                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                                    </path>
                                                </svg>
                                                {{ $program->team_count }} Panitia
                                            </div>
                                            <div
                                                class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100">
                                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $program->location }}
                                            </div>
                                        </div>

                                        <div class="mt-8 pt-8 border-t border-slate-100 flex justify-between items-center">
                                            <button onclick="showDetail({{ $program->id }})"
                                                class="group/btn px-6 py-3 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary transition-all flex items-center gap-2 shadow-xl shadow-slate-900/10">
                                                Lihat detail kegiatan
                                                <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="shrink-0 hidden lg:block">
                                        <div
                                            class="w-40 h-40 rounded-[2rem] bg-slate-50 border border-slate-100 flex flex-col items-center justify-center p-6 text-center shadow-inner">
                                            <span
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 italic">Schedule</span>
                                            <span
                                                class="text-4xl font-black text-slate-900 tracking-tighter">{{ \Carbon\Carbon::parse($program->start_date)->format('d') }}</span>
                                            <span
                                                class="text-xs font-bold text-primary uppercase">{{ \Carbon\Carbon::parse($program->start_date)->format('M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 bg-white rounded-[2rem] border border-slate-200">
                            <p class="text-slate-400 font-bold italic">Belum ada program kerja yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail (Full Implementation based on image) -->
    <div id="program-modal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 md:p-6 pointer-events-none">
            <div class="bg-white w-full max-w-4xl max-h-[90vh] rounded-[2.5rem] shadow-2xl overflow-hidden pointer-events-auto flex flex-col transform transition-all scale-95 opacity-0 duration-300"
                id="modal-content">
                <!-- Modal Header -->
                <div class="p-8 md:p-10 border-b border-slate-100 relative shrink-0">
                    <button onclick="closeModal()"
                        class="absolute top-8 right-8 p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <h2 id="m-title" class="text-2xl md:text-3xl font-black text-slate-900 pr-12 leading-tight mb-1">
                        Judul Program</h2>
                    <p id="m-division" class="text-slate-400 font-bold text-sm uppercase tracking-widest">Divisi
                        Organisasi</p>
                </div>

                <!-- Modal Body -->
                <div class="p-8 md:p-10 overflow-y-auto space-y-10 custom-scrollbar">
                    <!-- Badges Row -->
                    <div class="flex flex-wrap gap-3 items-center">
                        <span id="m-status-badge"
                            class="px-4 py-1.5 rounded-full bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/20">Selesai</span>
                        <div
                            class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-600">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span id="m-date">Range Tanggal</span>
                        </div>
                        <div
                            class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-600">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span id="m-location">Lokasi</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-black text-slate-900 tracking-tight flex items-center gap-2">
                            Deskripsi Program
                        </h4>
                        <p id="m-description" class="text-slate-500 font-medium leading-relaxed">
                            Detail deskripsi akan muncul di sini...
                        </p>
                    </div>

                    <!-- Ketua Program -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-black text-slate-900 tracking-tight">Ketua Program</h4>
                        <div class="bg-amber-100/50 border border-amber-200/50 rounded-3xl p-6 flex items-center gap-6">
                            <div
                                class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-900 border-4 border-white shadow-lg shrink-0">
                                <img id="m-head-image" src="" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h5 id="m-head-name" class="text-lg font-black text-slate-900">Nama Ketua</h5>
                                <p id="m-head-role"
                                    class="text-slate-500 font-semibold text-xs border-t border-amber-200/50 mt-1 pt-1 italic">
                                    Ketua Program Kerja</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tim Pelaksana -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-black text-slate-900 tracking-tight">Tim Pelaksana</h4>
                        <div id="m-team-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Team cards will be injected here -->
                        </div>
                    </div>

                    <!-- Informasi Program Grid -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-black text-slate-900 tracking-tight flex items-center gap-2">
                            Informasi Program
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div
                                class="bg-amber-100/30 rounded-3xl p-6 text-center border border-amber-200/30 group hover:bg-amber-100/50 transition-colors">
                                <div
                                    class="w-10 h-10 rounded-xl bg-pink-100/50 text-pink-600 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <p id="m-participants" class="text-2xl font-black text-slate-900 leading-tight">0</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Peserta</p>
                            </div>
                            <div
                                class="bg-amber-100/30 rounded-3xl p-6 text-center border border-amber-200/30 group hover:bg-amber-100/50 transition-colors">
                                <div
                                    class="w-10 h-10 rounded-xl bg-pink-100/50 text-pink-600 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <p id="m-budget" class="text-2xl font-black text-slate-900 leading-tight">Rp -</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Anggaran</p>
                            </div>
                            <div
                                class="bg-amber-100/30 rounded-3xl p-6 text-center border border-amber-200/30 group hover:bg-amber-100/50 transition-colors">
                                <div
                                    class="w-10 h-10 rounded-xl bg-pink-100/50 text-pink-600 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <p id="m-team-count" class="text-2xl font-black text-slate-900 leading-tight">0</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Tim Inti</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumentasi -->
                    <div class="space-y-6 pb-4">
                        <h4 class="text-lg font-black text-slate-900 tracking-tight flex items-center gap-2">
                            Dokumentasi
                        </h4>
                        <div id="m-images-container" class="grid grid-cols-1 gap-6">
                            <!-- Main documentation image -->
                            <div
                                class="bg-slate-100 rounded-[2rem] overflow-hidden border border-slate-200 aspect-[16/9] flex items-center justify-center text-slate-400 italic">
                                Belum ada dokumentasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }

        .animate-spin-slow {
            animation: spin 4s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .program-item {
            opacity: 0;
            transform: translateY(30px);
        }

        .program-item.revealed {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <script>
        const programs = @json($programs);

        function showDetail(id) {
            const program = programs.find(p => p.id === id);
            if (!program) return;

            // Titles & Text
            document.getElementById('m-title').innerText = program.name;
            document.getElementById('m-division').innerText = program.division ? program.division.name : 'UMUM';
            document.getElementById('m-description').innerText = program.description;
            document.getElementById('m-location').innerText = program.location;

            // Dates
            const start = new Date(program.start_date);
            const end = new Date(program.end_date);
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            document.getElementById('m-date').innerText = start.toLocaleDateString('id-ID', options) + (program
                .start_date !== program.end_date ? ' - ' + end.toLocaleDateString('id-ID', options) : '');

            // Status Badge
            const badge = document.getElementById('m-status-badge');
            badge.innerText = program.status;
            badge.className = `px-4 py-1.5 rounded-full text-white text-[10px] font-black uppercase tracking-widest shadow-lg ${
                program.status === 'selesai' ? 'bg-emerald-500 shadow-emerald-500/20' : 
                (program.status === 'berjalan' ? 'bg-blue-500 shadow-blue-500/20' : 'bg-slate-400 shadow-slate-400/20')
            }`;

            // Stats
            document.getElementById('m-participants').innerText = program.participants_count;
            document.getElementById('m-budget').innerText = program.budget || 'Rp -';
            document.getElementById('m-team-count').innerText = program.team_count;

            // Head (Ketua)
            if (program.head) {
                document.getElementById('m-head-name').innerText = program.head.name;
                document.getElementById('m-head-image').src = program.head.image ? `/storage/${program.head.image}` :
                    `https://ui-avatars.com/api/?name=${encodeURIComponent(program.head.name)}&background=0f172a&color=fff&bold=true`;
                document.getElementById('m-head-role').innerText = program.head.position ? program.head.position.name :
                    'Ketua Program Kerja';
            }

            // Teams
            const teamContainer = document.getElementById('m-team-container');
            teamContainer.innerHTML = '';
            program.teams.forEach(team => {
                const member = team.member;
                const card = `
                    <div class="bg-amber-100/30 rounded-[1.5rem] p-4 flex items-center gap-4 border border-amber-200/30">
                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                            <img src="${member.image ? '/storage/'+member.image : 'https://ui-avatars.com/api/?name='+encodeURIComponent(member.name)+'&background=0f172a&color=fff'}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h6 class="text-sm font-black text-slate-900">${member.name}</h6>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">${team.role || 'Anggota'}</p>
                        </div>
                    </div>
                `;
                teamContainer.innerHTML += card;
            });

            // Images / Documentation
            const imgContainer = document.getElementById('m-images-container');
            if (program.images && program.images.length > 0) {
                imgContainer.innerHTML = '';
                program.images.forEach(img => {
                    imgContainer.innerHTML += `<div class="rounded-[2rem] overflow-hidden shadow-xl group border border-slate-100">
                        <img src="/storage/${img.image_path}" class="w-full h-auto transform transition-transform duration-700 group-hover:scale-110">
                    </div>`;
                });
            } else {
                imgContainer.innerHTML = `<div class="bg-slate-50 rounded-[2rem] overflow-hidden border border-slate-200 aspect-[16/9] flex items-center justify-center text-slate-400 italic font-bold">
                    <p>Belum ada dokumentasi ditambahkan</p>
                </div>`;
            }

            // Show Modal
            const modal = document.getElementById('program-modal');
            const content = document.getElementById('modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('program-modal');
            const content = document.getElementById('modal-content');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        function filterPrograms(status) {
            const items = document.querySelectorAll('.program-item');
            items.forEach(item => {
                if (status === 'all' || item.getAttribute('data-status') === status) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Scroll Reveal
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.program-item').forEach(item => {
                const rect = item.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.9) {
                    item.classList.add('revealed');
                }
            });
        });
        window.dispatchEvent(new Event('scroll'));
    </script>
@endsection
