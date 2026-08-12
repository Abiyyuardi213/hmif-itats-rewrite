@extends('layouts.admin')

@section('title', 'Manajemen Calon Ketua Himpunan (Cakahim)')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <a href="{{ route('admin.voting-schedules.index') }}" class="hover:text-slate-600 transition-colors">Jadwal Pemilu</a>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Calon Cakahim</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Data Calon Cakahim & Visi Misi</h1>
                <p class="text-sm text-slate-500">Kelola daftar kandidat ketua himpunan, nomor urut paslon, foto, visi, dan misi.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                <i class="fas fa-user-plus mr-2 text-[10px]"></i>
                Tambah Candidate / Cakahim
            </button>
        </div>

        <!-- Filter Sesi Pemilihan -->
        <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">Pilih Sesi Pemilihan:</label>
                <select onchange="window.location.href='{{ route('admin.candidates.index') }}?schedule_id=' + this.value"
                    class="px-3 py-2 border border-slate-200 rounded-md text-sm bg-white font-semibold text-slate-800 focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    @foreach($schedules as $s)
                        <option value="{{ $s->id }}" {{ $s->id == $selectedScheduleId ? 'selected' : '' }}>
                            {{ $s->title }} {{ $s->is_active ? '— (Aktif)' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if($selectedScheduleId)
                @php $currentS = $schedules->firstWhere('id', $selectedScheduleId); @endphp
                @if($currentS)
                    <span class="text-xs font-mono font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-md">
                        Periode: {{ $currentS->start_time->format('d M Y') }} s/d {{ $currentS->end_time->format('d M Y') }}
                    </span>
                @endif
            @endif
        </div>

        <!-- Candidate Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($candidates as $candidate)
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:border-slate-300 transition-all">
                    <!-- Top Badge & Header -->
                    <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <span class="w-9 h-9 rounded-full bg-slate-900 text-white font-black text-sm flex items-center justify-center shadow-md">
                            0{{ $candidate->candidate_number }}
                        </span>
                        <span class="text-xs font-bold font-mono px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-md border border-emerald-100">
                            <i class="fas fa-vote-yea text-[10px] mr-1"></i> {{ $candidate->votes_count }} Suara
                        </span>
                    </div>

                    <!-- Photo & Name -->
                    <div class="p-6 flex flex-col items-center text-center space-y-3">
                        <div class="w-28 h-28 rounded-full bg-slate-100 ring-4 ring-slate-100 overflow-hidden shadow-inner relative">
                            @if($candidate->photo)
                                <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <i class="fas fa-user-tie text-4xl"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 text-lg leading-tight">{{ $candidate->name }}</h3>
                            <p class="text-xs font-mono font-medium text-slate-400 mt-0.5">{{ $candidate->npm ?? 'NPM -' }}</p>
                        </div>
                    </div>

                    <!-- Vision & Mission Preview -->
                    <div class="px-6 py-4 bg-slate-50/30 border-t border-slate-100 flex-1 space-y-3 text-xs">
                        <div>
                            <p class="font-bold text-slate-500 uppercase tracking-wider text-[10px]">Visi</p>
                            <p class="text-slate-700 font-medium line-clamp-2 mt-0.5 italic">"{{ $candidate->vision }}"</p>
                        </div>
                        <div>
                            <p class="font-bold text-slate-500 uppercase tracking-wider text-[10px]">Misi</p>
                            <p class="text-slate-600 line-clamp-3 mt-0.5 whitespace-pre-line">{{ $candidate->mission }}</p>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-4 border-t border-slate-100 bg-white flex items-center justify-end gap-2">
                        <button onclick='openEditModal(@json($candidate))'
                            class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-md text-xs font-semibold transition-colors">
                            <i class="fas fa-edit mr-1 text-[10px]"></i> Edit Data
                        </button>
                        <button onclick="confirmDelete({{ $candidate->id }}, '{{ $candidate->name }}')"
                            class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-md text-xs font-semibold transition-colors">
                            <i class="fas fa-trash-alt mr-1 text-[10px]"></i> Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 bg-white border border-slate-200 rounded-xl text-center">
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto text-slate-300 mb-3">
                        <i class="fas fa-user-slash text-2xl"></i>
                    </div>
                    <p class="text-slate-500 font-medium text-sm italic">Belum ada paslon Cakahim yang didaftarkan pada sesi ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Create Modal -->
    <div id="create-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="create-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200" onclick="closeCreateModal()"></div>
        <div id="create-content" class="relative bg-white w-full max-w-xl rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200 my-8">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Tambah Calon Cakahim Baru</h3>
                <button onclick="closeCreateModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form action="{{ route('admin.candidates.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">No. Urut <span class="text-rose-500">*</span></label>
                        <input type="number" name="candidate_number" min="1" required placeholder="1"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                    <div class="space-y-1.5 col-span-2">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Sesi Pemilihan <span class="text-rose-500">*</span></label>
                        <select name="voting_schedule_id" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white font-semibold focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                            @foreach($schedules as $s)
                                <option value="{{ $s->id }}" {{ $s->id == $selectedScheduleId ? 'selected' : '' }}>{{ $s->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Pilih Dari Anggota Aktif Himpunan <span class="text-rose-500">*</span></label>
                    <select name="org_member_id" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white font-semibold focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                        <option value="">-- Pilih Anggota Himpunan --</option>
                        @foreach($activeMembers as $m)
                            <option value="{{ $m->id }}">
                                {{ $m->name }} ({{ $m->npm ?? 'NPM -' }}) — {{ optional($m->position)->name ?? 'Anggota' }} {{ $m->division ? '('.$m->division->name.')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Visi Kandidat <span class="text-rose-500">*</span></label>
                    <textarea name="vision" rows="3" required placeholder="Tuliskan visi kandidat..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Misi Kandidat <span class="text-rose-500">*</span></label>
                    <textarea name="mission" rows="4" required placeholder="Gunakan baris baru untuk setiap poin misi..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm">Simpan Kandidat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="edit-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200" onclick="closeEditModal()"></div>
        <div id="edit-content" class="relative bg-white w-full max-w-xl rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200 my-8">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Perbarui Data Cakahim</h3>
                <button onclick="closeEditModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="edit-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">No. Urut <span class="text-rose-500">*</span></label>
                        <input type="number" name="candidate_number" id="edit-candidate_number" min="1" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                    <div class="space-y-1.5 col-span-2">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Sesi Pemilihan <span class="text-rose-500">*</span></label>
                        <select name="voting_schedule_id" id="edit-voting_schedule_id" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white font-semibold focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                            @foreach($schedules as $s)
                                <option value="{{ $s->id }}">{{ $s->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Pilih Dari Anggota Aktif Himpunan <span class="text-rose-500">*</span></label>
                    <select name="org_member_id" id="edit-org_member_id" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white font-semibold focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                        <option value="">-- Pilih Anggota Himpunan --</option>
                        @foreach($activeMembers as $m)
                            <option value="{{ $m->id }}">
                                {{ $m->name }} ({{ $m->npm ?? 'NPM -' }}) — {{ optional($m->position)->name ?? 'Anggota' }} {{ $m->division ? '('.$m->division->name.')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Visi Kandidat <span class="text-rose-500">*</span></label>
                    <textarea name="vision" id="edit-vision" rows="3" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Misi Kandidat <span class="text-rose-500">*</span></label>
                    <textarea name="mission" id="edit-mission" rows="4" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="delete-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        const createModalRoot = document.getElementById('create-modal-root');
        const createOverlay = document.getElementById('create-overlay');
        const createContent = document.getElementById('create-content');

        function openCreateModal() {
            createModalRoot.classList.remove('hidden');
            createModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                createOverlay.classList.replace('opacity-0', 'opacity-100');
                createContent.classList.remove('translate-y-4', 'opacity-0');
                createContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeCreateModal() {
            createOverlay.classList.replace('opacity-100', 'opacity-0');
            createContent.classList.replace('translate-y-0', 'opacity-100');
            createContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                createModalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        const editModalRoot = document.getElementById('edit-modal-root');
        const editOverlay = document.getElementById('edit-overlay');
        const editContent = document.getElementById('edit-content');

        function openEditModal(candidate) {
            const form = document.getElementById('edit-form');
            form.action = `/admin/candidates/${candidate.id}`;
            document.getElementById('edit-candidate_number').value = candidate.candidate_number;
            document.getElementById('edit-voting_schedule_id').value = candidate.voting_schedule_id;
            document.getElementById('edit-org_member_id').value = candidate.org_member_id || '';
            document.getElementById('edit-vision').value = candidate.vision;
            document.getElementById('edit-mission').value = candidate.mission;

            editModalRoot.classList.remove('hidden');
            editModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                editOverlay.classList.replace('opacity-0', 'opacity-100');
                editContent.classList.remove('translate-y-4', 'opacity-0');
                editContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeEditModal() {
            editOverlay.classList.replace('opacity-100', 'opacity-0');
            editContent.classList.replace('translate-y-0', 'opacity-100');
            editContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                editModalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Paslon?',
                text: `Kandidat "${name}" akan dihapus dari sistem.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = `/admin/candidates/${id}`;
                    form.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    </script>
@endsection
