@extends('layouts.admin')

@section('title', 'Manajemen Role')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Manajemen Role</h1>
                <p class="text-slate-500 mt-1">Kelola peran dan hak akses pengguna dalam sistem.</p>
            </div>
            <div>
                <button onclick="toggleModal('modal-add-role')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-slate-900/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Role Baru
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-100 animate-in fade-in duration-300"
                role="alert">
                <span class="font-bold">Sukses!</span> {{ session('success') }}
            </div>
        @endif

        <!-- Roles Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Role</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Display Name
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($roles as $role)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm text-slate-500">#{{ $role->id }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                    <span
                                        class="px-2 py-1 rounded-md bg-slate-100 text-slate-700 font-mono text-xs">{{ $role->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $role->display_name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                    {{ $role->description ?? '-' }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button onclick="editRole({{ json_encode($role) }})"
                                        class="inline-flex items-center justify-center p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')"
                                            class="inline-flex items-center justify-center p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                            </path>
                                        </svg>
                                        <p>Belum ada role yang tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Role -->
    <div id="modal-add-role" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="toggleModal('modal-add-role')"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-6">
            <div
                class="bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden animate-in zoom-in duration-300">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900">Tambah Role Baru</h3>
                    <button onclick="toggleModal('modal-add-role')" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.roles.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 uppercase">Nama Role (Unique)</label>
                        <input type="text" name="name" required placeholder="e.g., administrator"
                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 uppercase">Display Name</label>
                        <input type="text" name="display_name" required placeholder="e.g., Administrator"
                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 uppercase">Deskripsi</label>
                        <textarea name="description" rows="3" placeholder="Deskripsi mengenai role ini..."
                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all"></textarea>
                    </div>
                    <div class="pt-4 flex items-center gap-3">
                        <button type="button" onclick="toggleModal('modal-add-role')"
                            class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-900 text-sm font-bold text-white hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10">
                            Simpan Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Role -->
    <div id="modal-edit-role" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="toggleModal('modal-edit-role')"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-6">
            <div
                class="bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden animate-in zoom-in duration-300">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900">Edit Role</h3>
                    <button onclick="toggleModal('modal-edit-role')" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="form-edit-role" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 uppercase">Nama Role (Unique)</label>
                        <input type="text" name="name" id="edit-name" required placeholder="e.g., administrator"
                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 uppercase">Display Name</label>
                        <input type="text" name="display_name" id="edit-display-name" required
                            placeholder="e.g., Administrator"
                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 uppercase">Deskripsi</label>
                        <textarea name="description" id="edit-description" rows="3" placeholder="Deskripsi mengenai role ini..."
                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none text-sm transition-all"></textarea>
                    </div>
                    <div class="pt-4 flex items-center gap-3">
                        <button type="button" onclick="toggleModal('modal-edit-role')"
                            class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-900 text-sm font-bold text-white hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10">
                            Perbarui Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        function editRole(role) {
            const form = document.getElementById('form-edit-role');
            form.action = `/admin/role/${role.id}`;
            document.getElementById('edit-name').value = role.name;
            document.getElementById('edit-display-name').value = role.display_name;
            document.getElementById('edit-description').value = role.description || '';
            toggleModal('modal-edit-role');
        }
    </script>
@endsection
