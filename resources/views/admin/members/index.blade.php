@extends('layouts.admin')

@section('title', 'Manajemen Anggota Himpunan')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <span class="hover:text-slate-600 transition-colors">Admin</span>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Anggota</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Anggota Himpunan</h1>
                <p class="text-sm text-slate-500">Kelola profil, penempatan divisi, dan foto anggota.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95 group">
                <i class="fas fa-plus mr-2 text-[10px] group-hover:rotate-90 transition-transform"></i>
                Tambah Anggota
            </button>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Anggota</p>
                        <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ count($members) }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pengurus Inti</p>
                        <p class="text-2xl font-bold text-slate-900 tracking-tight">
                            {{ $members->filter(fn($m) => optional($m->position)->type == 'inti')->count() }}
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Staff Divisi</p>
                        <p class="text-2xl font-bold text-slate-900 tracking-tight">
                            {{ $members->filter(fn($m) => optional($m->position)->type != 'inti')->count() }}
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <!-- Toolbar -->
            <div class="p-4 border-b border-slate-100 bg-slate-50/30 flex flex-col sm:flex-row gap-4 justify-between">
                <div class="relative max-w-sm w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="member-search" onkeyup="filterMembers()"
                        placeholder="Cari nama, NPM, atau jabatan..."
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md bg-white text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-300 transition-all">
                </div>
                <!-- Optional Filters could go here -->
            </div>

            <!-- Table -->
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
                                            class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden ring-1 ring-slate-200 flex-shrink-0 relative group-hover:scale-105 transition-transform">
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
                                        <div class="flex items-center gap-1.5 search-division">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            <span class="text-xs font-medium text-slate-600">
                                                {{ $member->division->name }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-[11px] text-slate-300 italic search-division">General</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-1 opacity-70 group-hover:opacity-100 transition-opacity">
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
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <div
                                            class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                            <i class="fas fa-folder-open text-xl"></i>
                                        </div>
                                        <p class="text-slate-400 text-sm italic">Belum ada data anggota aktif.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $members->links() }}
            </div>
        </div>
    </div>

    <!-- Shared Modal Container -->
    <div id="modal-container" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="modal-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeAllModals()"></div>

        <!-- Detail Modal Content -->
        <div id="detail-content"
            class="relative bg-white w-full max-w-sm rounded-lg shadow-xl hidden transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Detail Anggota</h3>
                <button onclick="closeAllModals()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <div class="p-6">
                <div class="flex flex-col items-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-slate-100 ring-4 ring-slate-50 overflow-hidden mb-4">
                        <img id="d-image" src="" class="w-full h-full object-cover hidden">
                        <div id="d-image-placeholder"
                            class="w-full h-full flex items-center justify-center text-slate-300">
                            <i class="fas fa-user text-3xl"></i>
                        </div>
                    </div>
                    <h2 id="d-name" class="text-lg font-bold text-slate-900 text-center leading-tight"></h2>
                    <p id="d-npm" class="text-sm text-slate-500 font-mono mt-1"></p>
                    <div id="d-badge-container" class="mt-2"></div>
                </div>

                <div class="space-y-4 text-sm">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Jabatan</p>
                            <p id="d-position" class="font-medium text-slate-700"></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Divisi</p>
                            <p id="d-division" class="font-medium text-slate-700"></p>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-4 pt-4 border-t border-slate-100">
                        <a id="d-instagram" href="#" target="_blank"
                            class="flex items-center gap-2 text-slate-500 hover:text-pink-600 transition-colors text-xs font-medium">
                            <i class="fab fa-instagram text-lg"></i> Instagram
                        </a>
                        <span class="w-px h-4 bg-slate-200"></span>
                        <a id="d-linkedin" href="#" target="_blank"
                            class="flex items-center gap-2 text-slate-500 hover:text-blue-600 transition-colors text-xs font-medium">
                            <i class="fab fa-linkedin text-lg"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Modal Content -->
        <div id="form-content"
            class="relative bg-white w-full max-w-2xl rounded-lg shadow-xl hidden transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200 flex flex-col max-h-[90vh]">

            <div
                class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50 flex-shrink-0">
                <h3 id="form-modal-title" class="font-semibold text-slate-900">Kelola Anggota</h3>
                <button onclick="closeAllModals()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <form id="member-form" class="flex-1 overflow-y-auto p-6 space-y-5">
                @csrf
                <div class="flex flex-col sm:flex-row gap-6">
                    <!-- Image Input -->
                    <div class="flex flex-col items-center space-y-3">
                        <div
                            class="relative w-28 h-28 rounded-full ring-4 ring-slate-50 overflow-hidden bg-slate-100 shadow-sm group">
                            <img id="f-image-preview" src="" class="w-full h-full object-cover hidden">
                            <div id="f-image-placeholder"
                                class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                <i class="fas fa-camera text-2xl mb-1"></i>
                                <span class="text-[10px]">Upload</span>
                            </div>
                            <label for="f-image-input"
                                class="absolute inset-0 bg-slate-900/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer text-white">
                                <i class="fas fa-edit text-xl"></i>
                            </label>
                        </div>
                        <input type="file" id="f-image-input" accept="image/*" class="hidden"
                            onchange="handleImageSelect(this)">
                        <p class="text-[10px] text-slate-400 text-center max-w-[120px]">JPG/PNG Max 10MB.</p>
                    </div>

                    <!-- Fields -->
                    <div class="flex-1 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5 md:col-span-2">
                                <label class="text-xs font-semibold text-slate-700">Nama Lengkap <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" name="name" id="f-name" required
                                    class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700">NPM</label>
                                <input type="text" name="npm" id="f-npm"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700">Urutan (Order) <span
                                        class="text-rose-500">*</span></label>
                                <input type="number" name="order" id="f-order" required value="0"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700">Jabatan <span
                                        class="text-rose-500">*</span></label>
                                <select name="position_id" id="f-position_id" required
                                    class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($positions as $pos)
                                        <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700">Divisi</label>
                                <select name="division_id" id="f-division_id"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                                    <option value="">Tanpa Divisi (General)</option>
                                    @foreach ($divisions as $div)
                                        <option value="{{ $div->id }}">{{ $div->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700"><i
                                class="fab fa-instagram mr-1 text-pink-500"></i> Instagram URL</label>
                        <input type="url" name="instagram_url" id="f-instagram_url"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700"><i
                                class="fab fa-linkedin mr-1 text-blue-600"></i> LinkedIn URL</label>
                        <input type="url" name="linkedin_url" id="f-linkedin_url"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                </div>
            </form>

            <div
                class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-end gap-3 flex-shrink-0">
                <button type="button" onclick="closeAllModals()"
                    class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors">Batal</button>
                <button type="button" id="f-submit-btn" onclick="submitForm()"
                    class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                    <span id="f-btn-text">Simpan</span>
                </button>
            </div>
        </div>

        <!-- Cropper Modal Content -->
        <div id="cropper-content"
            class="relative bg-white w-full max-w-lg rounded-lg shadow-xl hidden transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200 flex flex-col max-h-[90vh]">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Sesuaikan Foto</h3>
                <button onclick="cancelCrop()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <div class="relative bg-slate-900 h-64 sm:h-80 w-full">
                <img id="cropper-image" src="" class="block max-w-full">
            </div>
            <div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-3 bg-white">
                <button onclick="cancelCrop()"
                    class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors">Batal</button>
                <button onclick="applyCrop()"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                    Potong & Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="delete-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // --- Global Variables ---
        let cropper = null;
        let originalImageFile = null;
        let croppedImageBlob = null;
        let currentMode = 'create';
        let currentMemberId = null;

        // --- Filtering ---
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

        // --- Shared Modal Logic ---
        const modalContainer = document.getElementById('modal-container');
        const modalOverlay = document.getElementById('modal-overlay');
        const detailContent = document.getElementById('detail-content');
        const formContent = document.getElementById('form-content');
        const cropperContent = document.getElementById('cropper-content');

        function toggleModal(type, show = true) {
            if (show) {
                modalContainer.classList.remove('hidden');
                modalContainer.classList.add('flex');
                document.body.style.overflow = 'hidden';

                // Hide all contents first
                [detailContent, formContent, cropperContent].forEach(c => c.classList.add('hidden'));

                // Determine content to show
                let content;
                if (type === 'detail') content = detailContent;
                if (type === 'form') content = formContent;
                if (type === 'cropper') content = cropperContent;

                if (content) {
                    content.classList.remove('hidden');
                    setTimeout(() => {
                        modalOverlay.classList.remove('opacity-0');
                        modalOverlay.classList.add('opacity-100');
                        content.classList.remove('scale-95', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }
            } else {
                modalOverlay.classList.remove('opacity-100');
                modalOverlay.classList.add('opacity-0');

                [detailContent, formContent, cropperContent].forEach(c => {
                    c.classList.remove('scale-100', 'opacity-100');
                    c.classList.add('scale-95', 'opacity-0');
                });

                setTimeout(() => {
                    modalContainer.classList.add('hidden');
                    modalContainer.classList.remove('flex');
                    [detailContent, formContent, cropperContent].forEach(c => c.classList.add('hidden'));
                    document.body.style.overflow = 'auto';

                    // Cleanup cropper if closed
                    if (cropper) {
                        cropper.destroy();
                        cropper = null;
                    }
                    if (type === 'reset') resetForm(); // Optional reset
                }, 200);
            }
        }

        function closeAllModals() {
            toggleModal(null, false);
        }

        // --- Detail Modal Logic ---
        function openDetailModal(m) {
            document.getElementById('d-name').innerText = m.name;
            document.getElementById('d-npm').innerText = m.npm || '-';
            document.getElementById('d-division').innerText = m.division ? m.division.name : 'General';
            document.getElementById('d-position').innerText = m.position ? m.position.name : 'Anggota';

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

            const container = document.getElementById('d-badge-container');
            const isInti = m.position && m.position.type === 'inti';
            container.innerHTML =
                `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest border ${isInti ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-green-50 text-green-700 border-green-100'}">${isInti ? 'IN' : 'ST'} - ${isInti ? 'PENGURUS INTI' : 'STAFF ORGANISASI'}</span>`;

            const igBtn = document.getElementById('d-instagram');
            const inBtn = document.getElementById('d-linkedin');

            igBtn.style.display = m.instagram_url ? 'flex' : 'none';
            if (m.instagram_url) igBtn.href = m.instagram_url;

            inBtn.style.display = m.linkedin_url ? 'flex' : 'none';
            if (m.linkedin_url) inBtn.href = m.linkedin_url;

            toggleModal('detail');
        }

        // --- Form Logic ---
        function openCreateModal() {
            resetForm();
            currentMode = 'create';
            currentMemberId = null;
            document.getElementById('form-modal-title').innerText = 'Tambah Anggota';
            document.getElementById('f-btn-text').innerText = 'Simpan';
            toggleModal('form');
        }

        function openEditModal(m) {
            resetForm();
            currentMode = 'edit';
            currentMemberId = m.id;
            document.getElementById('form-modal-title').innerText = 'Edit Anggota';
            document.getElementById('f-btn-text').innerText = 'Update';

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

            toggleModal('form');
        }

        function resetForm() {
            document.getElementById('member-form').reset();
            document.getElementById('f-image-preview').src = '';
            document.getElementById('f-image-preview').classList.add('hidden');
            document.getElementById('f-image-placeholder').classList.remove('hidden');
            document.getElementById('f-image-input').value = '';
            document.getElementById('f-submit-btn').disabled = false;
            croppedImageBlob = null;
            originalImageFile = null;
        }

        function handleImageSelect(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                if (file.size > 10 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File terlalu besar',
                        text: 'Maksimal ukuran file adalah 10MB.',
                        confirmButtonColor: '#0f172a'
                    });
                    input.value = '';
                    return;
                }
                originalImageFile = file;
                const reader = new FileReader();
                reader.onload = function(e) {
                    openCropper(e.target.result);
                }
                reader.readAsDataURL(file);
            }
        }

        // --- Cropper Logic ---
        function openCropper(imageSrc) {
            // Logic to switch from Form to Cropper within the same modal container
            // We just toggle content visibility

            const formC = document.getElementById('form-content');
            const cropC = document.getElementById('cropper-content');

            formC.classList.add('hidden');
            cropC.classList.remove('hidden');

            // Re-apply transitions just in case (optional, but keeps it clean)
            cropC.classList.remove('scale-95', 'opacity-0');
            cropC.classList.add('scale-100', 'opacity-100');

            const cropperImage = document.getElementById('cropper-image');
            cropperImage.src = imageSrc;

            if (cropper) cropper.destroy();
            cropper = new Cropper(cropperImage, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 0.8,
            });
        }

        function cancelCrop() {
            // Return to form
            const formC = document.getElementById('form-content');
            const cropC = document.getElementById('cropper-content');

            cropC.classList.add('hidden');
            formC.classList.remove('hidden');
            document.getElementById('f-image-input').value = '';
            if (cropper) cropper.destroy();
        }

        function applyCrop() {
            if (!cropper) return;
            cropper.getCroppedCanvas({
                width: 500,
                height: 500
            }).toBlob((blob) => {
                croppedImageBlob = blob;
                const url = URL.createObjectURL(blob);
                const preview = document.getElementById('f-image-preview');
                preview.src = url;
                preview.classList.remove('hidden');
                document.getElementById('f-image-placeholder').classList.add('hidden');

                // Return to form
                const formC = document.getElementById('form-content');
                const cropC = document.getElementById('cropper-content');
                cropC.classList.add('hidden');
                formC.classList.remove('hidden');

                if (cropper) cropper.destroy();
            }, 'image/jpeg', 0.9);
        }

        // --- AJAX Submit ---
        async function submitForm() {
            const btn = document.getElementById('f-submit-btn');

            const name = document.getElementById('f-name').value;
            const position = document.getElementById('f-position_id').value;
            const order = document.getElementById('f-order').value;

            if (!name || !position || !order) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data tidak lengkap',
                    text: 'Mohon isi Nama, Jabatan, dan Urutan.',
                    confirmButtonColor: '#0f172a',
                    customClass: {
                        popup: 'rounded-md border border-slate-100 shadow-lg'
                    }
                });
                return;
            }

            const formData = new FormData();
            formData.append('name', name);
            formData.append('npm', document.getElementById('f-npm').value);
            formData.append('position_id', position);
            formData.append('division_id', document.getElementById('f-division_id').value || '');
            formData.append('order', order);
            formData.append('instagram_url', document.getElementById('f-instagram_url').value);
            formData.append('linkedin_url', document.getElementById('f-linkedin_url').value);
            formData.append('_token', '{{ csrf_token() }}');

            if (croppedImageBlob) {
                formData.append('image', croppedImageBlob, 'profile.jpg');
            }

            let url = "{{ route('admin.members.store') }}";
            if (currentMode === 'edit') {
                url = `/admin/members/${currentMemberId}`;
            }

            btn.disabled = true;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Error saving data');
                }

                // Close modals immediately
                closeAllModals();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data disimpan.',
                    timer: 1500,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'rounded-md border border-slate-100 shadow-lg'
                    }
                }).then(() => {
                    window.location.reload();
                });

            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message,
                    confirmButtonColor: '#0f172a',
                    customClass: {
                        popup: 'rounded-md border border-slate-100 shadow-lg'
                    }
                });
                btn.disabled = false;
            }
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus anggota?',
                text: `Anggota "${name}" akan dihapus.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-md border border-slate-200 shadow-xl',
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
