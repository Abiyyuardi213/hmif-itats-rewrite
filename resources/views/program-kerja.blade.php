@extends('layouts.app')

@section('title', 'Program Kerja - HMIF ITATS')

@section('content')
    <div class="bg-white min-h-screen pb-20">
        <!-- Hero Section -->
        <section class="py-20 md:py-28 bg-slate-50 border-b border-slate-100">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <!-- Badge -->
                <div
                    class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-medium text-slate-800 mb-6 backdrop-blur-sm shadow-sm">
                    <span class="mr-2 h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                    Program Kerja Strategis
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-[1.1]">
                    Rangkai Kegiatan <br>
                    <span class="text-primary/80">HMIF ITATS</span>
                </h1>

                <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed mb-10">
                    Daftar inisiatif dan program kerja yang dirancang untuk pengembangan mahasiswa Informatika yang
                    progresif dan kontributif.
                </p>

                <!-- Status Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto mb-10">
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                        <span class="block text-2xl font-bold text-slate-900">{{ $programs->count() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Program</span>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                        <span
                            class="block text-2xl font-bold text-emerald-500">{{ $programs->where('status', 'selesai')->count() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Selesai</span>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                        <span
                            class="block text-2xl font-bold text-blue-500">{{ $programs->where('status', 'berjalan')->count() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Berjalan</span>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                        <span
                            class="block text-2xl font-bold text-slate-400">{{ $programs->where('status', 'mendatang')->count() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Mendatang</span>
                    </div>
                </div>

                <!-- Tabs/Filters -->
                <div class="flex flex-wrap justify-center gap-3">
                    <button
                        class="filter-btn active px-6 py-2 rounded-xl bg-slate-900 text-white text-xs font-bold transition-all shadow-lg shadow-slate-900/10"
                        onclick="filterPrograms('all', this)">
                        Semua
                    </button>
                    <button
                        class="filter-btn px-6 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all shadow-sm"
                        onclick="filterPrograms('selesai', this)">
                        Selesai
                    </button>
                    <button
                        class="filter-btn px-6 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all shadow-sm"
                        onclick="filterPrograms('berjalan', this)">
                        Berjalan
                    </button>
                    <button
                        class="filter-btn px-6 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all shadow-sm"
                        onclick="filterPrograms('mendatang', this)">
                        Mendatang
                    </button>
                </div>
            </div>
        </section>

        <!-- Timeline Content -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="relative">
                <!-- Vertical Progress Line (The Tree) -->
                <div
                    class="absolute left-6 md:left-12 top-0 bottom-0 w-1 bg-gradient-to-b from-slate-200 via-slate-200 to-transparent rounded-full">
                </div>

                <div class="space-y-16" id="programs-container">
                    @forelse($programs as $program)
                        <div class="program-item relative pl-16 md:pl-28 transition-all duration-700 reveal-on-scroll"
                            data-status="{{ $program->status }}">

                            <!-- Timeline Marker (Branching Point) -->
                            <div
                                class="absolute left-2.5 md:left-8 top-0 w-8 h-8 md:w-10 md:h-10 rounded-xl bg-white border-2 flex items-center justify-center shadow-md z-10 transition-all duration-300
                                @if ($program->status == 'selesai') border-emerald-500 text-emerald-500 
                                @elseif($program->status == 'berjalan') border-blue-500 text-blue-500 
                                @else border-slate-300 text-slate-400 @endif">
                                <i
                                    class="fas @if ($program->status == 'selesai') fa-check @elseif($program->status == 'berjalan') fa-spinner fa-spin @else fa-calendar @endif text-xs md:text-sm"></i>
                            </div>

                            <!-- Modern Card Design -->
                            <div
                                class="group bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row gap-6 md:items-center">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider border 
                                            @if ($program->status == 'selesai') bg-emerald-50 text-emerald-600 border-emerald-100 
                                            @elseif($program->status == 'berjalan') bg-blue-50 text-blue-600 border-blue-100 
                                            @else bg-slate-50 text-slate-500 border-slate-100 @endif">
                                            {{ $program->status }}
                                        </span>
                                        <span
                                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $program->division->name ?? 'General' }}</span>
                                    </div>

                                    <h3
                                        class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors">
                                        {{ $program->name }}
                                    </h3>
                                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2 max-w-2xl">
                                        {{ $program->description }}
                                    </p>

                                    <div
                                        class="flex flex-wrap items-center gap-4 md:gap-8 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                        <div class="flex items-center gap-2">
                                            <i class="far fa-calendar text-primary"></i>
                                            {{ \Carbon\Carbon::parse($program->start_date)->format('d M Y') }}
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                            {{ $program->location }}
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-users text-primary"></i>
                                            {{ $program->team_count }} Panitia
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="shrink-0 pt-4 md:pt-0 border-t md:border-t-0 md:border-l border-slate-100 md:pl-8">
                                    <button onclick="showDetail({{ $program->id }})"
                                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 hover:bg-slate-900 text-slate-900 hover:text-white rounded-xl text-xs font-bold transition-all border border-slate-100 whitespace-nowrap">
                                        <span>Detail</span>
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200 ml-16 md:ml-28">
                            <div
                                class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100 text-slate-300">
                                <i class="fas fa-clipboard-list text-2xl"></i>
                            </div>
                            <p class="text-slate-400 font-medium font-italic">Belum ada program kerja yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail (Updated Design) -->
    <div id="program-modal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 md:p-6 pointer-events-none">
            <div class="bg-white w-full max-w-4xl max-h-[90vh] rounded-3xl shadow-2xl overflow-hidden pointer-events-auto flex flex-col transform transition-all scale-95 opacity-0 duration-300"
                id="modal-content">
                <!-- Modal Header -->
                <div class="p-8 border-b border-slate-100 relative shrink-0">
                    <button onclick="closeModal()"
                        class="absolute top-8 right-8 w-10 h-10 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-full transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="flex items-center gap-3 mb-2">
                        <span id="m-status-badge"
                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Status</span>
                        <span id="m-division"
                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Divisi</span>
                    </div>
                    <h2 id="m-title" class="text-2xl md:text-3xl font-bold text-slate-900 leading-tight">Judul Program
                    </h2>
                </div>

                <!-- Modal Body -->
                <div class="p-8 overflow-y-auto space-y-10 custom-scrollbar">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Waktu Pelaksanaan
                            </p>
                            <p id="m-date" class="text-sm font-bold text-slate-900">Tanggal</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Lokasi Kegiatan
                            </p>
                            <p id="m-location" class="text-sm font-bold text-slate-900">Lokasi</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Tim Pelaksana</p>
                            <p id="m-team-count" class="text-sm font-bold text-slate-900">0 Panitia</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-lg font-bold text-slate-900">Deskripsi Program</h4>
                        <p id="m-description" class="text-slate-500 text-sm leading-relaxed whitespace-pre-line"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Head of Program -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Ketua Program</h4>
                            <div class="p-4 rounded-2xl border border-slate-100 bg-slate-50/50 flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-xl overflow-hidden bg-white border border-slate-200 shrink-0">
                                    <img id="m-head-image" src="" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <h5 id="m-head-name" class="font-bold text-slate-900 text-sm truncate">Nama Ketua</h5>
                                    <p id="m-head-role" class="text-[10px] text-primary font-bold uppercase mt-0.5">Ketua
                                        Proker</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-900">Informasi Tambahan</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl border border-slate-100 bg-slate-50/50">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Peserta
                                    </p>
                                    <p id="m-participants" class="font-bold text-slate-900">0 Orang</p>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-100 bg-slate-50/50">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Anggaran
                                    </p>
                                    <p id="m-budget" class="font-bold text-slate-900">Rp -</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tim Pelaksana -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-bold text-slate-900">Tim Pelaksana</h4>
                        <div id="m-team-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Team cards injected here -->
                        </div>
                    </div>

                    <!-- Dokumentasi -->
                    <div class="space-y-4 pb-4">
                        <h4 class="text-lg font-bold text-slate-900">Dokumentasi</h4>
                        <div id="m-images-container" class="grid grid-cols-1 gap-6">
                            <!-- Documentation images injected here -->
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

        .filter-btn.active {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
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

            document.getElementById('m-title').innerText = program.name;
            document.getElementById('m-division').innerText = program.division ? program.division.name : 'UMUM';
            document.getElementById('m-description').innerText = program.description;
            document.getElementById('m-location').innerText = program.location;

            const start = new Date(program.start_date);
            const end = new Date(program.end_date);
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            document.getElementById('m-date').innerText = start.toLocaleDateString('id-ID', options) + (program
                .start_date !== program.end_date ? ' - ' + end.toLocaleDateString('id-ID', options) : '');

            const badge = document.getElementById('m-status-badge');
            badge.innerText = program.status;
            badge.className = `px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider ${
                program.status === 'selesai' ? 'bg-emerald-50 text-emerald-600' : 
                (program.status === 'berjalan' ? 'bg-blue-50 text-blue-600' : 'bg-slate-50 text-slate-500')
            }`;

            document.getElementById('m-participants').innerText = (program.participants_count || 0) + ' Peserta';

            // Smarter budget display
            let budgetText = 'Rp -';
            if (program.budget) {
                // If it's just numbers, format it
                if (!isNaN(program.budget) && !isNaN(parseFloat(program.budget))) {
                    budgetText = 'Rp ' + Number(program.budget).toLocaleString('id-ID');
                } else {
                    // If it already has symbols or text, show as is
                    budgetText = program.budget;
                }
            }
            document.getElementById('m-budget').innerText = budgetText;
            document.getElementById('m-team-count').innerText = program.team_count + ' Panitia';

            if (program.head) {
                document.getElementById('m-head-name').innerText = program.head.name;
                document.getElementById('m-head-image').src = program.head.image ? `/storage/${program.head.image}` :
                    `https://ui-avatars.com/api/?name=${encodeURIComponent(program.head.name)}&background=f8fafc&color=0f172a&bold=true`;
                document.getElementById('m-head-role').innerText = program.head.position ? program.head.position.name :
                    'Ketua Pelaksana';
            }

            const teamContainer = document.getElementById('m-team-container');
            teamContainer.innerHTML = '';
            program.teams.forEach(team => {
                const member = team.member;
                teamContainer.innerHTML += `
                    <div class="bg-white rounded-xl p-3 flex items-center gap-3 border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-lg overflow-hidden shrink-0 border border-slate-100">
                            <img src="${member.image ? '/storage/'+member.image : 'https://ui-avatars.com/api/?name='+encodeURIComponent(member.name)+'&background=f8fafc'}" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <h6 class="text-xs font-bold text-slate-900 truncate">${member.name}</h6>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">${team.role || 'Anggota'}</p>
                        </div>
                    </div>
                `;
            });

            const imgContainer = document.getElementById('m-images-container');
            if (program.images && program.images.length > 0) {
                imgContainer.innerHTML = '';
                program.images.forEach(img => {
                    imgContainer.innerHTML += `<div class="rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                        <img src="/storage/${img.image_path}" class="w-full h-auto">
                    </div>`;
                });
            } else {
                imgContainer.innerHTML = `<div class="bg-slate-50 rounded-2xl border border-slate-100 aspect-video flex items-center justify-center text-slate-300 italic text-sm">
                    <p>Belum ada dokumentasi</p>
                </div>`;
            }

            const modal = document.getElementById('program-modal');
            const content = document.getElementById('modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.remove('scale-95', 'opacity-0'), 10);
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

        function filterPrograms(status, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active', 'bg-slate-900', 'text-white');
                b.classList.add('bg-white', 'text-slate-600');
            });
            btn.classList.add('active', 'bg-slate-900', 'text-white');
            btn.classList.remove('bg-white', 'text-slate-600');

            const items = document.querySelectorAll('.program-item');
            items.forEach(item => {
                if (status === 'all' || item.getAttribute('data-status') === status) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Scroll Reveal Animation
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.reveal-on-scroll').forEach(item => {
                const rect = item.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.9) {
                    item.classList.add('revealed');
                }
            });
        });
        window.dispatchEvent(new Event('scroll'));
    </script>
@endsection
