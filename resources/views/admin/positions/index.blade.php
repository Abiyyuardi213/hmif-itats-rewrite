@extends('layouts.admin')

@section('title', 'Manajemen Jabatan')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumbs & Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <span class="hover:text-slate-600 transition-colors">Admin</span>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Jabatan</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Data Jabatan</h1>
                <p class="text-sm text-slate-500">Kelola struktur dan tingkatan posisi dalam organisasi HMIF.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                <i class="fas fa-plus mr-2 text-[10px]"></i>
                Tambah Jabatan
            </button>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Jabatan</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ count($positions) }}</p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pengurus Inti</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">
                    {{ $positions->where('type', 'inti')->count() }}
                </p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Staff Divisi</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">
                    {{ $positions->where('type', 'divisi')->count() }}
                </p>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Jabatan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Deskripsi
                            </th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Tipe</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-center">
                                Urutan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($positions as $position)
                            <tr class="group hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                            <i class="fas fa-briefcase text-xs"></i>
                                        </div>
                                        <span class="font-medium text-slate-900">{{ $position->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-600 max-w-xs line-clamp-2">
                                        {{ $position->description ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest border 
                                        {{ $position->type == 'inti' ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-amber-50 text-amber-700 border-amber-100' }}">
                                        <span
                                            class="w-1 h-1 rounded-full mr-1.5 {{ $position->type == 'inti' ? 'bg-indigo-600' : 'bg-amber-600' }}"></span>
                                        {{ $position->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 text-xs font-bold">
                                        #{{ $position->order }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick="openEditModal({{ json_encode($position) }})"
                                            class="p-1.5 text-slate-400 hover:text-slate-900 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $position->id }}, '{{ $position->name }}')"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">
                                    Belum ada data jabatan yang tersimpan.
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
        <div id="create-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeCreateModal()"></div>
        <div id="create-content"
            class="relative bg-white w-full max-w-lg rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Tambah Jabatan</h3>
                <button onclick="closeCreateModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form action="{{ route('admin.positions.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama Jabatan</label>
                    <input type="text" name="name" required placeholder="Contoh: Ketua Himpunan"
                        class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Deskripsi
                        (Opsional)</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi singkat tentang jabatan..."
                        class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Tipe Jabatan</label>
                        <select name="type" required
                            class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm bg-white focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all">
                            <option value="inti">Pengurus Inti</option>
                            <option value="divisi">Divisi / Staff</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Urutan</label>
                        <input type="number" name="order" required value="0"
                            class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all">
                    </div>
                </div>
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeCreateModal()"
                        class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div id="edit-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeEditModal()"></div>
        <div id="edit-content"
            class="relative bg-white w-full max-w-lg rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Perbarui Jabatan</h3>
                <button onclick="closeEditModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="edit-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama Jabatan</label>
                    <input type="text" name="name" id="edit-name" required
                        class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Deskripsi
                        (Opsional)</label>
                    <textarea name="description" id="edit-description" rows="3" placeholder="Deskripsi singkat tentang jabatan..."
                        class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Tipe Jabatan</label>
                        <select name="type" id="edit-type" required
                            class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm bg-white focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all">
                            <option value="inti">Pengurus Inti</option>
                            <option value="divisi">Divisi / Staff</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Urutan</label>
                        <input type="number" name="order" id="edit-order" required
                            class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none transition-all">
                    </div>
                </div>
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Update
                        Jabatan</button>
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
        // Create Modal
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

        // Edit Modal
        const editModalRoot = document.getElementById('edit-modal-root');
        const editOverlay = document.getElementById('edit-overlay');
        const editContent = document.getElementById('edit-content');

        function openEditModal(position) {
            const form = document.getElementById('edit-form');
            form.action = `/admin/positions/${position.id}`;
            document.getElementById('edit-name').value = position.name;
            document.getElementById('edit-description').value = position.description || '';
            document.getElementById('edit-type').value = position.type;
            document.getElementById('edit-order').value = position.order;

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
                title: 'Hapus Jabatan?',
                text: `Anda akan menghapus jabatan "${name}". Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-lg border border-slate-200 shadow-xl',
                    confirmButton: 'px-4 py-2 rounded-md font-medium text-sm',
                    cancelButton: 'px-4 py-2 rounded-md font-medium text-sm text-slate-600'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = `/admin/positions/${id}`;
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
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-md border border-slate-100 shadow-lg'
                }
            });
        @endif
    </script>
@endsection
