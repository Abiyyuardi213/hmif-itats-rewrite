@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8" x-data="{ selectedCandidate: null }">
        <div class="max-w-7xl mx-auto space-y-10">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
                
                <div class="relative z-10 max-w-3xl space-y-4">
                    <span class="inline-flex items-center gap-2 rounded-full border border-pink-500/30 bg-pink-500/10 px-4 py-1.5 text-xs font-bold text-pink-400 uppercase tracking-widest backdrop-blur-md">
                        <i class="fas fa-vote-yea"></i> E-Voting Pemilu Cakahim HMIF ITATS
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                        {{ $activeSchedule->title ?? 'Pemilihan Ketua Himpunan' }}
                    </h1>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        {{ $activeSchedule->description ?? 'Gunakan hak pilih Anda secara bijak untuk menentukan arah kepengurusan Himpunan Mahasiswa Teknik Informatika ITATS periode mendatang.' }}
                    </p>

                    @if($activeSchedule)
                        <div class="pt-4 flex flex-wrap items-center gap-4 text-xs font-mono text-slate-300">
                            <div class="flex items-center gap-2 bg-white/10 px-3.5 py-2 rounded-xl backdrop-blur-sm border border-white/10">
                                <i class="far fa-clock text-pink-400"></i>
                                <span>Waktu Voting: {{ $activeSchedule->start_time->format('d M H:i') }} - {{ $activeSchedule->end_time->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center gap-2 bg-white/10 px-3.5 py-2 rounded-xl backdrop-blur-sm border border-white/10">
                                <i class="fas fa-users text-pink-400"></i>
                                <span>Total Suara Masuk: {{ $totalVotes }} Vote</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Messages Alert -->
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 text-emerald-800 text-sm font-semibold shadow-sm">
                    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl flex items-center gap-3 text-rose-800 text-sm font-semibold shadow-sm">
                    <i class="fas fa-exclamation-circle text-rose-500 text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Candidates Grid (Dynamic width, max 4 columns) -->
            @if($activeSchedule && $activeSchedule->candidates->count() > 0)
                @php
                    $count = $activeSchedule->candidates->count();
                    $gridCols = match(true) {
                        $count === 1 => 'grid-cols-1 max-w-md mx-auto',
                        $count === 2 => 'grid-cols-1 sm:grid-cols-2 max-w-3xl mx-auto',
                        $count === 3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto',
                        default => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
                    };
                @endphp

                <div class="grid {{ $gridCols }} gap-6 justify-center">
                    @foreach($activeSchedule->candidates as $candidate)
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <div>
                                <!-- Header & Number -->
                                <div class="bg-slate-900 p-4 text-white relative overflow-hidden">
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="flex items-center gap-2.5 min-w-0 flex-1">
                                            <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-pink-500 to-rose-600 font-black text-sm flex items-center justify-center shadow-md flex-shrink-0">
                                                0{{ $candidate->candidate_number }}
                                            </span>
                                            <div class="min-w-0 flex-1">
                                                <h3 class="text-sm font-bold leading-tight truncate text-white" title="{{ $candidate->name }}">{{ $candidate->name }}</h3>
                                                <p class="text-[10px] font-mono text-slate-400 mt-0.5 truncate">{{ $candidate->npm ?? 'Cakahim' }}</p>
                                            </div>
                                        </div>

                                        <div class="bg-slate-800/80 px-2 py-1 rounded-lg border border-slate-700/60 text-right flex-shrink-0">
                                            <span class="text-xs font-black text-pink-400 block leading-none">{{ $candidate->votes_count }}</span>
                                            <span class="text-[8px] font-bold uppercase tracking-wider text-slate-400 block mt-0.5">Suara</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Photo Banner -->
                                <div class="relative h-64 sm:h-72 bg-slate-100 overflow-hidden">
                                    @if($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-full h-full object-cover object-top">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                            <i class="fas fa-user-tie text-5xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Actions Footer -->
                            <div class="p-5 space-y-3 bg-white border-t border-slate-100">
                                <button onclick="openDetailModal({{ json_encode($candidate) }})"
                                    class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold text-xs transition-colors flex items-center justify-center gap-2">
                                    <i class="fas fa-eye text-pink-500"></i>
                                    Lihat Visi & Misi
                                </button>

                                @if($activeSchedule->isOpen())
                                    <button onclick="openVoteModal({{ json_encode($candidate) }})"
                                        class="w-full py-3 bg-slate-900 hover:bg-pink-600 text-white rounded-xl font-bold text-xs tracking-wide shadow-md hover:shadow-pink-600/25 transition-all duration-300 flex items-center justify-center gap-2 group">
                                        <i class="fas fa-check-circle group-hover:scale-110 transition-transform"></i>
                                        PILIH PASLON NO 0{{ $candidate->candidate_number }}
                                    </button>
                                @else
                                    <button disabled
                                        class="w-full py-3 bg-slate-100 text-slate-400 rounded-xl font-bold text-xs cursor-not-allowed">
                                        Sesi Ditutup
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-24 bg-white border-2 border-dashed border-slate-200 rounded-3xl text-center space-y-4">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
                        <i class="fas fa-calendar-times text-2xl"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-slate-800">Tidak Ada Sesi Pemilihan Aktif Saat Ini</h3>
                        <p class="text-sm text-slate-500 max-w-md mx-auto">Panitia Pemilu HMIF ITATS belum membuka jadwal voting baru. Silakan cek kembali nanti.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Detail Visi & Misi Modal -->
    <div id="detail-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="detail-overlay" class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm opacity-0 transition-opacity duration-200" onclick="closeDetailModal()"></div>
        <div id="detail-content" class="relative bg-white w-full max-w-lg rounded-2xl shadow-xl translate-y-4 opacity-0 transition-all duration-200 overflow-hidden my-8">
            <div class="bg-slate-900 px-5 py-4 text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span id="d-candidate-number" class="w-8 h-8 rounded-lg bg-pink-500 font-bold text-xs flex items-center justify-center shadow-sm"></span>
                    <div>
                        <h3 id="d-candidate-name" class="font-bold text-sm leading-tight"></h3>
                        <p id="d-candidate-npm" class="text-[11px] font-mono text-slate-400"></p>
                    </div>
                </div>
                <button onclick="closeDetailModal()" class="p-1 text-slate-400 hover:text-white transition-colors">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>

            <div class="p-5 sm:p-6 space-y-5 max-h-[70vh] overflow-y-auto">
                <div class="flex items-center gap-3.5 p-3.5 bg-slate-50 rounded-xl">
                    <div class="w-12 h-12 rounded-lg bg-slate-200 overflow-hidden flex-shrink-0">
                        <img id="d-candidate-photo" src="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-widest text-pink-600 bg-pink-50 px-2 py-0.5 rounded">Visi & Misi Cakahim</span>
                        <h4 id="d-candidate-title" class="font-bold text-slate-900 text-xs mt-0.5"></h4>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-pink-600 uppercase tracking-wider">
                        <i class="fas fa-bullseye"></i> Visi Utama
                    </span>
                    <p id="d-candidate-vision" class="text-slate-700 font-medium text-xs leading-relaxed italic bg-pink-50/40 p-3.5 rounded-xl"></p>
                </div>

                <div class="space-y-1.5">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <i class="fas fa-list-ol"></i> Misi & Program Kerja
                    </span>
                    <div id="d-candidate-mission" class="text-slate-600 text-xs leading-relaxed whitespace-pre-line bg-slate-50 p-3.5 rounded-xl"></div>
                </div>
            </div>

            <div class="p-4 bg-slate-50 flex items-center justify-end">
                <button type="button" onclick="closeDetailModal()" class="px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Vote Confirmation Modal -->
    <div id="vote-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="vote-overlay" class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm opacity-0 transition-opacity duration-200" onclick="closeVoteModal()"></div>
        <div id="vote-content" class="relative bg-white w-full max-w-md rounded-2xl shadow-xl translate-y-4 opacity-0 transition-all duration-200 overflow-hidden my-8">
            <div class="bg-slate-900 px-6 py-5 text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span id="m-candidate-number" class="w-8 h-8 rounded-xl bg-pink-500 font-bold text-sm flex items-center justify-center"></span>
                    <h3 class="font-bold text-base">Konfirmasi Suara Voting</h3>
                </div>
                <button onclick="closeVoteModal()" class="p-1 text-slate-400 hover:text-white transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <form action="{{ route('voting.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="voting_schedule_id" value="{{ $activeSchedule->id ?? '' }}">
                <input type="hidden" name="candidate_id" id="m-candidate-id">

                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-slate-200 overflow-hidden flex-shrink-0">
                        <img id="m-candidate-photo" src="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Anda Memilih Paslon</p>
                        <p id="m-candidate-name" class="font-bold text-slate-900 text-sm leading-tight"></p>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Status Pemilih <span class="text-rose-500">*</span></label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center justify-center gap-2 p-3 border border-slate-200 rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors [&:has(input:checked)]:border-pink-500 [&:has(input:checked)]:bg-pink-50/50 [&:has(input:checked)]:text-pink-600 font-bold text-xs">
                                <input type="radio" name="voter_type" value="mahasiswa" checked onchange="toggleVoterType(this.value)" class="accent-pink-600">
                                <i class="fas fa-user-graduate"></i> Mahasiswa
                            </label>
                            <label class="flex items-center justify-center gap-2 p-3 border border-slate-200 rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors [&:has(input:checked)]:border-pink-500 [&:has(input:checked)]:bg-pink-50/50 [&:has(input:checked)]:text-pink-600 font-bold text-xs">
                                <input type="radio" name="voter_type" value="dosen" onchange="toggleVoterType(this.value)" class="accent-pink-600">
                                <i class="fas fa-chalkboard-teacher"></i> Dosen
                            </label>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap Pemilih <span class="text-rose-500">*</span></label>
                        <input type="text" name="voter_name" required placeholder="Nama lengkap Anda..."
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 outline-none transition-all">
                    </div>

                    <div id="voter-npm-container" class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Nomor Pokok Mahasiswa (NPM) <span class="text-rose-500">*</span></label>
                        <input type="text" name="voter_npm" id="voter_npm_input" required placeholder="Contoh: 13.2023.1.00000"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm font-mono focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 outline-none transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Email (Opsional)</label>
                        <input type="email" name="voter_email" placeholder="email@example.com"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 outline-none transition-all">
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeVoteModal()" class="px-4 py-2.5 text-slate-600 text-xs font-bold hover:bg-slate-50 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-xl text-xs font-bold shadow-lg shadow-pink-600/20 transition-all active:scale-95">
                        KIRIM SUARA SAYA
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const detailModalRoot = document.getElementById('detail-modal-root');
        const detailOverlay = document.getElementById('detail-overlay');
        const detailContent = document.getElementById('detail-content');

        function openDetailModal(candidate) {
            document.getElementById('d-candidate-number').innerText = `0${candidate.candidate_number}`;
            document.getElementById('d-candidate-name').innerText = candidate.name;
            document.getElementById('d-candidate-npm').innerText = candidate.npm || 'NPM -';
            document.getElementById('d-candidate-title').innerText = candidate.name;
            document.getElementById('d-candidate-vision').innerText = `"${candidate.vision}"`;
            document.getElementById('d-candidate-mission').innerText = candidate.mission;

            const photoEl = document.getElementById('d-candidate-photo');
            if(candidate.photo) {
                photoEl.src = `/storage/${candidate.photo}`;
            } else {
                photoEl.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(candidate.name)}&background=f1f5f9&color=0f172a&bold=true`;
            }

            detailModalRoot.classList.remove('hidden');
            detailModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                detailOverlay.classList.replace('opacity-0', 'opacity-100');
                detailContent.classList.remove('translate-y-4', 'opacity-0');
                detailContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeDetailModal() {
            detailOverlay.classList.replace('opacity-100', 'opacity-0');
            detailContent.classList.replace('translate-y-0', 'opacity-100');
            detailContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                detailModalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        function toggleVoterType(type) {
            const container = document.getElementById('voter-npm-container');
            const input = document.getElementById('voter_npm_input');
            if (type === 'dosen') {
                container.classList.add('hidden');
                input.removeAttribute('required');
                input.value = '';
            } else {
                container.classList.remove('hidden');
                input.setAttribute('required', 'required');
            }
        }

        const voteModalRoot = document.getElementById('vote-modal-root');
        const voteOverlay = document.getElementById('vote-overlay');
        const voteContent = document.getElementById('vote-content');

        function openVoteModal(candidate) {
            document.getElementById('m-candidate-id').value = candidate.id;
            document.getElementById('m-candidate-number').innerText = `0${candidate.candidate_number}`;
            document.getElementById('m-candidate-name').innerText = candidate.name;
            
            const photoEl = document.getElementById('m-candidate-photo');
            if(candidate.photo) {
                photoEl.src = `/storage/${candidate.photo}`;
            } else {
                photoEl.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(candidate.name)}&background=f1f5f9&color=0f172a&bold=true`;
            }

            voteModalRoot.classList.remove('hidden');
            voteModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                voteOverlay.classList.replace('opacity-0', 'opacity-100');
                voteContent.classList.remove('translate-y-4', 'opacity-0');
                voteContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeVoteModal() {
            voteOverlay.classList.replace('opacity-100', 'opacity-0');
            voteContent.classList.replace('translate-y-0', 'opacity-100');
            voteContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                voteModalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }
    </script>
@endsection
