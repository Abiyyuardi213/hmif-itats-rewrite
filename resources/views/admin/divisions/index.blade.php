@extends('layouts.admin')

@section('title', 'Manajemen Divisi')

@section('content')
    <div class="space-y-8 animate-in fade-in duration-700">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Data Divisi</h1>
                <p class="text-slate-500 mt-1 font-medium">Kelola struktur bidang dan departemen dalam organisasi HMIF.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-xl shadow-slate-900/20 hover:bg-slate-800 transition-all active:scale-95 group">
                <i class="fas fa-plus mr-2 text-xs group-hover:rotate-90 transition-transform"></i>
                Tambah Divisi Baru
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden bg-white/50 backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Divisi
                            </th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Visual &
                                Deskripsi</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">
                                Urutan</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">
                                Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($divisions as $division)
                            <tr class="group hover:bg-slate-50/80 transition-all duration-300">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl {{ $division->color ?: 'bg-slate-100 text-slate-400' }} flex items-center justify-center shadow-inner">
                                            <i class="fas {{ $division->icon ?: 'fa-layer-group' }} text-lg"></i>
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-900 block">{{ $division->name }}</span>
                                            <span
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">HMIF
                                                Department</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-sm text-slate-500 line-clamp-1 max-w-xs italic">
                                        {{ $division->description ?: 'Tidak ada deskripsi tersedia.' }}
                                    </p>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span
                                        class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-bold ring-1 ring-slate-200/50">
                                        #{{ $division->order }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick="openEditModal({{ json_encode($division) }})"
                                            class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white hover:shadow-sm rounded-xl transition-all border border-transparent hover:border-slate-100">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $division->id }}, '{{ $division->name }}')"
                                            class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-white hover:shadow-sm rounded-xl transition-all border border-transparent hover:border-slate-100">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div
                                        class="bg-slate-50 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-dashed border-slate-200 text-slate-300">
                                        <i class="fas fa-sitemap text-2xl"></i>
                                    </div>
                                    <p class="text-slate-400 font-medium italic">Belum ada data divisi yang tersimpan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="create-modal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeCreateModal()">
        </div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-xl rounded-3xl shadow-2xl overflow-hidden transform transition-all scale-95 opacity-0 duration-300"
                id="create-content">
                <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Tambah Divisi</h2>
                        <p class="text-xs text-slate-500 mt-0.5 font-medium uppercase tracking-widest">Konfigurasi Divisi
                            Organisasi</p>
                    </div>
                    <button onclick="closeCreateModal()"
                        class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-full transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.divisions.store') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama
                                Divisi</label>
                            <input type="text" name="name" required placeholder="Contoh: Humas"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Urutan</label>
                            <input type="number" name="order" required value="0"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Icon
                                (FontAwesome)</label>
                            <input type="text" name="icon" placeholder="fa-users"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Color Class
                                (Tailwind)</label>
                            <input type="text" name="color" placeholder="bg-pink-500 text-white"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi
                            Singkat</label>
                        <textarea name="description" rows="3" placeholder="Jelaskan peran divisi ini..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium resize-none"></textarea>
                    </div>
                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeCreateModal()"
                            class="flex-1 px-6 py-3 border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all">Batal</button>
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-xl shadow-slate-900/20 hover:bg-slate-800 transition-all">Simpan
                            Divisi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-xl rounded-3xl shadow-2xl overflow-hidden transform transition-all scale-95 opacity-0 duration-300"
                id="edit-content">
                <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Perbarui Divisi</h2>
                        <p class="text-xs text-slate-500 mt-0.5 font-medium uppercase tracking-widest">Master Data Divisi
                        </p>
                    </div>
                    <button onclick="closeEditModal()"
                        class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-full transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="edit-form" method="POST" class="p-8 space-y-5">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama
                                Divisi</label>
                            <input type="text" name="name" id="edit-name" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Urutan</label>
                            <input type="number" name="order" id="edit-order" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Icon
                                (FontAwesome)</label>
                            <input type="text" name="icon" id="edit-icon"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Color Class
                                (Tailwind)</label>
                            <input type="text" name="color" id="edit-color"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi
                            Singkat</label>
                        <textarea name="description" id="edit-description" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all text-sm font-medium resize-none"></textarea>
                    </div>
                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeEditModal()"
                            class="flex-1 px-6 py-3 border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all">Batal</button>
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-xl shadow-slate-900/20 hover:bg-slate-800 transition-all active:scale-95">Update
                            Divisi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="delete-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Success Notification
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
                    popup: 'rounded-2xl shadow-xl border border-emerald-100',
                }
            });
        @endif

        function openCreateModal() {
            const modal = document.getElementById('create-modal');
            const content = document.getElementById('create-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.remove('scale-95', 'opacity-0'), 10);
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            const modal = document.getElementById('create-modal');
            const content = document.getElementById('create-content');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        function openEditModal(division) {
            const modal = document.getElementById('edit-modal');
            const content = document.getElementById('edit-content');
            const form = document.getElementById('edit-form');

            form.action = `/admin/divisions/${division.id}`;
            document.getElementById('edit-name').value = division.name;
            document.getElementById('edit-order').value = division.order;
            document.getElementById('edit-icon').value = division.icon || '';
            document.getElementById('edit-color').value = division.color || '';
            document.getElementById('edit-description').value = division.description || '';

            modal.classList.remove('hidden');
            setTimeout(() => content.classList.remove('scale-95', 'opacity-0'), 10);
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-modal');
            const content = document.getElementById('edit-content');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Divisi?',
                text: `Anda akan menghapus divisi "${name}". Anggota di dalamnya mungkin akan kehilangan asosiasi divisi.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Hapus Divisi',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'px-6 py-3 rounded-xl font-bold text-sm',
                    cancelButton: 'px-6 py-3 rounded-xl font-bold text-sm text-slate-600'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = `/admin/divisions/${id}`;
                    form.submit();
                }
            })
        }
    </script>
@endsection
