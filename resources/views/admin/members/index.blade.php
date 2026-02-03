@extends('layouts.admin')

@section('title', 'Manajemen Anggota Himpunan')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumbs & Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <span class="hover:text-slate-600 transition-colors">Admin</span>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Anggota</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Anggota Himpunan</h1>
                <p class="text-sm text-slate-500">Kelola profil dan penempatan divisi anggota aktif.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                <i class="fas fa-plus mr-2 text-[10px]"></i>
                Tambah Anggota
            </button>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Anggota</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ count($members) }}</p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pengurus Inti</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">
                    {{ $members->filter(fn($m) => optional($m->position)->type == 'inti')->count() }}
                </p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Staff Divisi</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">
                    {{ $members->filter(fn($m) => optional($m->position)->type != 'inti')->count() }}
                </p>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <!-- Filter & Search -->
            <div class="p-4 border-b border-slate-100 bg-slate-50/30">
                <div class="relative max-w-sm">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="member-search" onkeyup="filterMembers()"
                        placeholder="Cari nama, NPM, atau jabatan..."
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md bg-white text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-300 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse" id="members-table">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Anggota</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Jabatan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Divisi</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($members as $member)
                            <tr class="group hover:bg-slate-50/40 transition-colors member-row">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden ring-1 ring-slate-200 flex-shrink-0">
                                            @if ($member->image)
                                                <img src="{{ asset('storage/' . $member->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <i class="fas fa-user text-lg"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-semibold text-slate-900 search-name">{{ $member->name }}</span>
                                            <span
                                                class="text-[11px] text-slate-400 font-medium tracking-tight search-npm">{{ $member->npm ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-widest border transition-colors search-position {{ optional($member->position)->type == 'inti' ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-slate-50 text-slate-600 border-slate-200' }}">
                                        {{ optional($member->position)->name ?? 'BPH' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($member->division)
                                        <span class="text-xs font-medium text-slate-600 search-division">
                                            {{ $member->division->name }}
                                        </span>
                                    @else
                                        <span class="text-[11px] text-slate-300 italic search-division">General</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick='openDetailModal(@json($member->load(['position', 'division'])))'
                                            class="p-1.5 text-slate-400 hover:text-slate-900 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                        <button onclick='openEditModal(@json($member))'
                                            class="p-1.5 text-slate-400 hover:text-blue-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $member->id }}, '{{ $member->name }}')"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <p class="text-slate-400 text-sm italic">Belum ada data anggota aktif.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Modal (Create & Edit) -->
    <div id="form-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div id="form-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeFormModal()"></div>
        <div id="form-content"
            class="relative bg-white w-full max-w-xl rounded-lg shadow-xl transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 id="form-modal-title" class="font-semibold text-slate-900">Tambah Anggota</h3>
                <button onclick="closeFormModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="member-form" action="" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5 md:col-span-2">
                        <label class="text-xs font-semibold text-slate-700">Nama Lengkap <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="f-name" required placeholder="Nama Lengkap"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">NPM</label>
                        <input type="text" name="npm" id="f-npm" placeholder="13.20XX.1.XXXXX"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Jabatan <span
                                class="text-rose-500">*</span></label>
                        <select name="position_id" id="f-position_id" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Divisi</label>
                        <select name="division_id" id="f-division_id"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                            <option value="">Tanpa Divisi (General)</option>
                            @foreach ($divisions as $div)
                                <option value="{{ $div->id }}">{{ $div->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Urutan (Order) <span
                                class="text-rose-500">*</span></label>
                        <input type="number" name="order" id="f-order" required value="0"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Instagram URL</label>
                        <input type="url" name="instagram_url" id="f-instagram_url"
                            placeholder="https://instagram.com/..."
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" id="f-linkedin_url"
                            placeholder="https://linkedin.com/in/..."
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-semibold text-slate-700">Foto Anggota</label>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0">
                                <img id="f-image-preview" src="" alt=""
                                    class="w-full h-full object-cover hidden">
                                <div id="f-image-placeholder"
                                    class="w-full h-full flex items-center justify-center text-slate-300">
                                    <i class="fas fa-user text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <input type="file" name="image" id="f-image" accept="image/*"
                                    onchange="previewImage(this)"
                                    class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition-all">
                                <p class="text-[10px] text-slate-400 mt-1">PNG, JPG, JPEG (Max. 2MB)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeFormModal()"
                        class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" id="f-submit-btn"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detail-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div id="detail-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeDetailModal()"></div>
        <div id="detail-content"
            class="relative bg-white w-full max-w-md rounded-lg shadow-xl transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200">
            <!-- Header with Cover/Avatar -->
            <div class="h-24 bg-gradient-to-r from-slate-900 to-slate-800"></div>
            <div class="px-6 pb-6 pt-0">
                <div class="relative -mt-12 mb-4 flex justify-center">
                    <div
                        class="w-24 h-24 rounded-full border-4 border-white bg-slate-100 shadow-sm overflow-hidden ring-1 ring-slate-200">
                        <img id="d-image" src="" alt="" class="w-full h-full object-cover hidden">
                        <div id="d-image-placeholder"
                            class="w-full h-full flex items-center justify-center text-slate-300">
                            <i class="fas fa-user text-4xl"></i>
                        </div>
                    </div>
                </div>

                <div class="text-center space-y-1 mb-6">
                    <h2 id="d-name" class="text-xl font-bold text-slate-900 leading-tight"></h2>
                    <p id="d-npm" class="text-sm font-medium text-slate-400"></p>
                    <div id="d-badge-container" class="pt-2"></div>
                </div>

                <div class="grid grid-cols-1 gap-3 py-4 border-t border-slate-100">
                    <div class="flex items-center justify-between py-1">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Divisi</span>
                        <span id="d-division" class="text-xs font-semibold text-slate-700"></span>
                    </div>
                    <div class="flex items-center justify-between py-1">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Jabatan</span>
                        <span id="d-position" class="text-xs font-semibold text-slate-700"></span>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="flex items-center justify-center gap-4 pt-4 border-t border-slate-100">
                    <a id="d-instagram" href="#" target="_blank"
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 hover:bg-pink-50 hover:text-pink-600 text-slate-400 transition-all">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a id="d-linkedin" href="#" target="_blank"
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-50 hover:bg-blue-50 hover:text-blue-600 text-slate-400 transition-all">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 text-center">
                <button onclick="closeDetailModal()"
                    class="w-full py-2 bg-white border border-slate-200 text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="delete-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function filterMembers() {
            const input = document.getElementById("member-search");
            const filter = input.value.toUpperCase();
            const rows = document.getElementsByClassName("member-row");

            for (let i = 0; i < rows.length; i++) {
                const nameText = rows[i].getElementsByClassName("search-name")[0].innerText.toUpperCase();
                const npmText = rows[i].getElementsByClassName("search-npm")[0].innerText.toUpperCase();
                const positionText = rows[i].getElementsByClassName("search-position")[0].innerText.toUpperCase();
                const divisionText = rows[i].getElementsByClassName("search-division")[0].innerText.toUpperCase();

                if (nameText.includes(filter) || npmText.includes(filter) || positionText.includes(filter) || divisionText
                    .includes(filter)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        const modalRoot = document.getElementById('detail-modal-root');
        const modalOverlay = document.getElementById('detail-overlay');
        const modalContent = document.getElementById('detail-content');

        function openDetailModal(m) {
            document.getElementById('d-name').innerText = m.name;
            document.getElementById('d-npm').innerText = m.npm || '-';
            document.getElementById('d-division').innerText = m.division ? m.division.name : 'General';
            document.getElementById('d-position').innerText = m.position ? m.position.name : 'Anggota';

            // Image handling
            const imgEl = document.getElementById('d-image');
            const placeholderEl = document.getElementById('d-image-placeholder');
            if (m.image) {
                imgEl.src = `/storage/${m.image}`;
                imgEl.classList.remove('hidden');
                placeholderEl.classList.add('hidden');
            } else {
                imgEl.classList.add('hidden');
                placeholderEl.classList.remove('hidden');
            }

            // Badge
            const container = document.getElementById('d-badge-container');
            const isInti = m.position && m.position.type === 'inti';
            container.innerHTML =
                `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest border ${isInti ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-slate-50 text-slate-600 border-slate-200'}">${isInti ? 'Pengurus Inti' : 'Staff Organisasi'}</span>`;

            // Socials
            const igBtn = document.getElementById('d-instagram');
            const inBtn = document.getElementById('d-linkedin');
            if (m.instagram_url) {
                igBtn.href = m.instagram_url;
                igBtn.classList.remove('hidden');
            } else {
                igBtn.classList.add('hidden');
            }
            if (m.linkedin_url) {
                inBtn.href = m.linkedin_url;
                inBtn.classList.remove('hidden');
            } else {
                inBtn.classList.add('hidden');
            }

            modalRoot.classList.remove('hidden');
            modalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                modalOverlay.classList.replace('opacity-0', 'opacity-100');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDetailModal() {
            modalOverlay.classList.replace('opacity-100', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modalRoot.classList.remove('flex');
                modalRoot.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        // Form Modal Logic
        const formModalRoot = document.getElementById('form-modal-root');
        const formOverlay = document.getElementById('form-overlay');
        const formContent = document.getElementById('form-content');

        function openFormModal() {
            formModalRoot.classList.remove('hidden');
            formModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                formOverlay.classList.replace('opacity-0', 'opacity-100');
                formContent.classList.remove('scale-95', 'opacity-0');
                formContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeFormModal() {
            formOverlay.classList.replace('opacity-100', 'opacity-0');
            formContent.classList.remove('scale-100', 'opacity-100');
            formContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                formModalRoot.classList.remove('flex');
                formModalRoot.classList.add('hidden');
                document.body.style.overflow = 'auto';
                document.getElementById('member-form').reset();
                document.getElementById('f-image-preview').classList.add('hidden');
                document.getElementById('f-image-placeholder').classList.remove('hidden');
            }, 200);
        }

        function openCreateModal() {
            const form = document.getElementById('member-form');
            form.action = "{{ route('admin.members.store') }}";
            document.getElementById('form-method').value = 'POST';
            document.getElementById('form-modal-title').innerText = 'Tambah Anggota Himpunan';
            document.getElementById('f-submit-btn').innerText = 'Simpan Anggota';
            openFormModal();
        }

        function openEditModal(m) {
            const form = document.getElementById('member-form');
            form.action = `/admin/members/${m.id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('form-modal-title').innerText = 'Edit Data Anggota';
            document.getElementById('f-submit-btn').innerText = 'Update Anggota';

            document.getElementById('f-name').value = m.name || '';
            document.getElementById('f-npm').value = m.npm || '';
            document.getElementById('f-position_id').value = m.position_id || '';
            document.getElementById('f-division_id').value = m.division_id || '';
            document.getElementById('f-order').value = m.order || 0;
            document.getElementById('f-instagram_url').value = m.instagram_url || '';
            document.getElementById('f-linkedin_url').value = m.linkedin_url || '';

            if (m.image) {
                const preview = document.getElementById('f-image-preview');
                preview.src = `/storage/${m.image}`;
                preview.classList.remove('hidden');
                document.getElementById('f-image-placeholder').classList.add('hidden');
            }

            openFormModal();
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('f-image-preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    document.getElementById('f-image-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus anggota?',
                text: `Data anggota "${name}" akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, hapus',
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
                    form.action = `/admin/members/${id}`;
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
