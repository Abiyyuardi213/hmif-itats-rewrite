@extends('layouts.admin')

@section('title', 'Manajemen Jadwal Pemilihan Cakahim')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <span class="hover:text-slate-600 transition-colors">Admin</span>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Jadwal Pemilu Cakahim</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Jadwal & Sesi Pemilihan (Voting)</h1>
                <p class="text-sm text-slate-500">Atur periode waktu pelaksanaan E-Voting pemilihan calon ketua himpunan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.candidates.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 bg-white text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
                    <i class="fas fa-users-cog mr-2 text-xs"></i>
                    Kelola Cakahim
                </a>
                <button onclick="openCreateModal()"
                    class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                    <i class="fas fa-plus mr-2 text-[10px]"></i>
                    Buat Jadwal Voting Baru
                </button>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Sesi Pemilihan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Waktu Pelaksanaan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-center">Jumlah Cakahim</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-center">Total Suara masuk</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-center">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($schedules as $schedule)
                            <tr class="group hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-900">{{ $schedule->title }}</span>
                                        <span class="text-xs text-slate-500 line-clamp-1">{{ $schedule->description ?? 'Tanpa deskripsi' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col text-xs space-y-0.5 font-mono">
                                        <span class="text-slate-700"><i class="fas fa-play text-[10px] text-emerald-500 mr-1"></i> {{ $schedule->start_time->format('d M Y, H:i') }}</span>
                                        <span class="text-slate-500"><i class="fas fa-stop text-[10px] text-rose-500 mr-1"></i> {{ $schedule->end_time->format('d M Y, H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        {{ $schedule->candidates_count }} Paslon
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-800">
                                        <i class="fas fa-vote-yea text-xs mr-1.5 text-slate-500"></i> {{ $schedule->votes_count }} Vote
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php $status = $schedule->status_label; @endphp
                                    @if($status === 'Sedang Berlangsung')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Berlangsung
                                        </span>
                                    @elseif($status === 'Belum Dimulai')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            Belum Dimulai
                                        </span>
                                    @elseif($status === 'Selesai')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-600 border border-rose-200">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.candidates.index', ['schedule_id' => $schedule->id]) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-md text-xs font-semibold transition-colors">
                                            <i class="fas fa-id-card mr-1 text-[10px]"></i> Cakahim
                                        </a>
                                        <button onclick="openEditModal({{ json_encode($schedule) }})"
                                            class="p-1.5 text-slate-400 hover:text-blue-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $schedule->id }}, '{{ $schedule->title }}')"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic">
                                    Belum ada jadwal pemilu / voting cakahim.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="create-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div id="create-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200" onclick="closeCreateModal()"></div>
        <div id="create-content" class="relative bg-white w-full max-w-lg rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Buat Sesi Pemilihan Voting</h3>
                <button onclick="closeCreateModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form action="{{ route('admin.voting-schedules.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Judul Pemilu / Sesi <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" required placeholder="Contoh: Pemilihan Ketua HMIF ITATS 2026/2027"
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Deskripsi Pemilu</label>
                    <textarea name="description" rows="2" placeholder="Keterangan singkat..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Waktu Mulai <span class="text-rose-500">*</span></label>
                        <input type="datetime-local" name="start_time" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Waktu Selesai <span class="text-rose-500">*</span></label>
                        <input type="datetime-local" name="end_time" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                </div>
                <div class="space-y-1.5 pt-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                        <span class="ml-2 text-sm font-medium text-slate-700">Status Sesi Aktif</span>
                    </label>
                </div>
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div id="edit-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200" onclick="closeEditModal()"></div>
        <div id="edit-content" class="relative bg-white w-full max-w-lg rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Perbarui Sesi Pemilihan</h3>
                <button onclick="closeEditModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="edit-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Judul Pemilu / Sesi <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="edit-title" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Deskripsi Pemilu</label>
                    <textarea name="description" id="edit-description" rows="2"
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Waktu Mulai <span class="text-rose-500">*</span></label>
                        <input type="datetime-local" name="start_time" id="edit-start_time" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Waktu Selesai <span class="text-rose-500">*</span></label>
                        <input type="datetime-local" name="end_time" id="edit-end_time" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                </div>
                <div class="space-y-1.5 pt-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" id="edit-is_active" value="1" class="sr-only peer">
                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                        <span class="ml-2 text-sm font-medium text-slate-700">Status Sesi Aktif</span>
                    </label>
                </div>
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm">Update Sesi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden Delete Form -->
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

        function openEditModal(schedule) {
            const form = document.getElementById('edit-form');
            form.action = `/admin/voting-schedules/${schedule.id}`;
            document.getElementById('edit-title').value = schedule.title;
            document.getElementById('edit-description').value = schedule.description || '';
            
            // Format datetime for datetime-local input
            const start = new Date(schedule.start_time).toISOString().slice(0, 16);
            const end = new Date(schedule.end_time).toISOString().slice(0, 16);
            document.getElementById('edit-start_time').value = start;
            document.getElementById('edit-end_time').value = end;
            document.getElementById('edit-is_active').checked = !!schedule.is_active;

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

        function confirmDelete(id, title) {
            Swal.fire({
                title: 'Hapus Jadwal Pemilu?',
                text: `Sesi "${title}" beserta data calon & suara akan dihapus.`,
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
                    form.action = `/admin/voting-schedules/${id}`;
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
