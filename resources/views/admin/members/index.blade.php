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
        </div>
    </div>

    <!-- Main Form Modal (Create & Edit) -->
    <div id="form-modal-root" class="fixed inset-0 z-[50] hidden items-center justify-center p-4">
        <div id="form-overlay"
            class="fixed inset-0 bg-slate-950/20 backdrop-blur-[2px] opacity-0 transition-opacity duration-200"
            onclick="closeFormModal()"></div>
        <div id="form-content"
            class="relative bg-white w-full max-w-2xl rounded-xl shadow-2xl transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200 flex flex-col max-h-[90vh]">

            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50 flex-shrink-0">
                <h3 id="form-modal-title" class="font-semibold text-slate-900">Tambah Anggota</h3>
                <button onclick="closeFormModal()"
                    class="p-2 text-slate-400 hover:text-slate-900 transition-colors rounded-full hover:bg-slate-100">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <!-- Form -->
            <form id="member-form" class="flex-1 overflow-y-auto p-6 space-y-5">
                @csrf
                <!-- Image Upload & Preview Section -->
                <div class="flex flex-col sm:flex-row gap-6">
                    <div class="flex flex-col items-center space-y-3">
                        <div
                            class="relative w-32 h-32 rounded-full ring-4 ring-slate-50 overflow-hidden bg-slate-100 shadow-sm group">
                            <img id="f-image-preview" src="" class="w-full h-full object-cover hidden">
                            <div id="f-image-placeholder"
                                class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                <i class="fas fa-camera text-2xl mb-1"></i>
                                <span class="text-[10px]">Upload</span>
                            </div>

                            <!-- Overlay for change -->
                            <label for="f-image-input"
                                class="absolute inset-0 bg-slate-900/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer text-white">
                                <i class="fas fa-edit text-xl"></i>
                            </label>
                        </div>
                        <input type="file" id="f-image-input" accept="image/*" class="hidden"
                            onchange="handleImageSelect(this)">
                        <p class="text-[10px] text-slate-400 text-center max-w-[120px]">
                            Klik gambar untuk ubah. JPG/PNG Max 10MB.
                        </p>
                    </div>

                    <div class="flex-1 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5 md:col-span-2">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama Lengkap
                                    <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" id="f-name" required
                                    class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all placeholder:text-slate-300"
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">NPM</label>
                                <input type="text" name="npm" id="f-npm"
                                    class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all placeholder:text-slate-300"
                                    placeholder="13.20XX.1.XXXXX">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Urutan (Order)
                                    <span class="text-rose-500">*</span></label>
                                <input type="number" name="order" id="f-order" required value="0"
                                    class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Jabatan <span
                                        class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <select name="position_id" id="f-position_id" required
                                        class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all">
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($positions as $pos)
                                            <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="fas fa-chevron-down absolute right-3 top-3 text-xs text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Divisi</label>
                                <div class="relative">
                                    <select name="division_id" id="f-division_id"
                                        class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all">
                                        <option value="">Tanpa Divisi (General)</option>
                                        @foreach ($divisions as $div)
                                            <option value="{{ $div->id }}">{{ $div->name }}</option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="fas fa-chevron-down absolute right-3 top-3 text-xs text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider"><i
                                class="fab fa-instagram mr-1 text-pink-500"></i> Instagram URL</label>
                        <input type="url" name="instagram_url" id="f-instagram_url"
                            class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all placeholder:text-slate-300"
                            placeholder="https://instagram.com/username">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider"><i
                                class="fab fa-linkedin mr-1 text-blue-600"></i> LinkedIn URL</label>
                        <input type="url" name="linkedin_url" id="f-linkedin_url"
                            class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all placeholder:text-slate-300"
                            placeholder="https://linkedin.com/in/username">
                    </div>
                </div>
            </form>

            <div
                class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-end gap-3 flex-shrink-0">
                <button type="button" onclick="closeFormModal()"
                    class="px-5 py-2.5 border border-slate-200 text-slate-600 rounded-lg text-sm font-medium hover:bg-white hover:border-slate-300 transition-all">Batal</button>
                <button type="button" id="f-submit-btn" onclick="submitForm()"
                    class="px-5 py-2.5 bg-slate-900 text-white rounded-lg text-sm font-medium hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20 active:scale-95 flex items-center">
                    <span id="f-btn-text">Simpan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Cropper Modal -->
    <div id="cropper-modal"
        class="fixed inset-0 z-[60] hidden items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-slate-800">Sesuaikan Foto</h3>
                <button onclick="cancelCrop()" class="text-slate-400 hover:text-slate-600"><i
                        class="fas fa-times"></i></button>
            </div>
            <div class="relative bg-slate-900 h-64 sm:h-80 w-full">
                <img id="cropper-image" src="" class="block max-w-full">
            </div>
            <div class="p-4 border-t border-slate-100 flex justify-end gap-3 bg-white">
                <button onclick="cancelCrop()"
                    class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-50 rounded-lg transition">Batal</button>
                <button onclick="applyCrop()"
                    class="px-4 py-2 bg-indigo-600 text-white font-medium hover:bg-indigo-700 rounded-lg shadow-lg shadow-indigo-500/30 transition">
                    <i class="fas fa-crop-simple mr-2"></i>Potong & Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detail-modal-root" class="fixed inset-0 z-[50] hidden items-center justify-center p-4">
        <div id="detail-overlay"
            class="fixed inset-0 bg-slate-950/20 backdrop-blur-[1px] opacity-0 transition-opacity duration-200"
            onclick="closeDetailModal()"></div>
        <div id="detail-content"
            class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200">
            <!-- Header with Cover/Avatar -->
            <div class="h-28 bg-gradient-to-br from-slate-800 to-slate-900 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pattern-dots"></div>
            </div>
            <div class="px-6 pb-8 pt-0 relative">
                <div class="flex justify-center -mt-14 mb-4">
                    <div
                        class="w-28 h-28 rounded-full border-4 border-white bg-slate-100 shadow-lg overflow-hidden ring-1 ring-slate-100">
                        <img id="d-image" src="" class="w-full h-full object-cover hidden">
                        <div id="d-image-placeholder"
                            class="w-full h-full flex items-center justify-center text-slate-300">
                            <i class="fas fa-user text-4xl"></i>
                        </div>
                    </div>
                </div>

                <div class="text-center space-y-2 mb-6">
                    <h2 id="d-name" class="text-xl font-bold text-slate-900 leading-tight"></h2>
                    <p id="d-npm" class="text-sm font-medium text-slate-500 font-mono"></p>
                    <div id="d-badge-container" class="pt-2"></div>
                </div>

                <div class="space-y-3">
                    <div class="p-3 bg-slate-50 rounded-lg flex items-center justify-between border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Divisi</span>
                        <span id="d-division" class="text-xs font-semibold text-slate-700"></span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-lg flex items-center justify-between border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jabatan</span>
                        <span id="d-position" class="text-xs font-semibold text-slate-700"></span>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="flex items-center justify-center gap-3 pt-6">
                    <a id="d-instagram" href="#" target="_blank"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-50 text-pink-500 hover:bg-pink-500 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a id="d-linkedin" href="#" target="_blank"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm">
                        <i class="fab fa-linkedin-in text-lg"></i>
                    </a>
                </div>
            </div>
            <button onclick="closeDetailModal()"
                class="absolute top-2 right-2 p-2 text-white/70 hover:text-white transition-colors">
                <i class="fas fa-times shadow-sm"></i>
            </button>
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
        let currentMode = 'create'; // 'create' or 'edit'
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

        // --- UI Modal Handling ---
        function showModal(rootId, overlayId, contentId) {
            const root = document.getElementById(rootId);
            const overlay = document.getElementById(overlayId);
            const content = document.getElementById(contentId);

            root.classList.remove('hidden');
            root.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Prevent scrolling

            setTimeout(() => {
                overlay.classList.replace('opacity-0', 'opacity-100');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function hideModal(rootId, overlayId, contentId, callback) {
            const root = document.getElementById(rootId);
            const overlay = document.getElementById(overlayId);
            const content = document.getElementById(contentId);

            overlay.classList.replace('opacity-100', 'opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                root.classList.remove('flex');
                root.classList.add('hidden');
                document.body.style.overflow = 'auto';
                if (callback) callback();
            }, 200);
        }

        const formModal = {
            open: () => showModal('form-modal-root', 'form-overlay', 'form-content'),
            close: () => hideModal('form-modal-root', 'form-overlay', 'form-content', resetForm)
        };

        const detailModal = {
            open: () => showModal('detail-modal-root', 'detail-overlay', 'detail-content'),
            close: () => hideModal('detail-modal-root', 'detail-overlay', 'detail-content')
        };

        function closeFormModal() {
            formModal.close();
        }

        function closeDetailModal() {
            detailModal.close();
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
                `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest border ${isInti ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-green-50 text-green-700 border-green-100'}">${isInti ? 'Pengurus Inti' : 'Staff Organisasi'}</span>`;

            const igBtn = document.getElementById('d-instagram');
            const inBtn = document.getElementById('d-linkedin');

            igBtn.style.display = m.instagram_url ? 'flex' : 'none';
            if (m.instagram_url) igBtn.href = m.instagram_url;

            inBtn.style.display = m.linkedin_url ? 'flex' : 'none';
            if (m.linkedin_url) inBtn.href = m.linkedin_url;

            detailModal.open();
        }

        // --- Form Logic & Cropper ---

        function openCreateModal() {
            resetForm();
            currentMode = 'create';
            currentMemberId = null;
            document.getElementById('form-modal-title').innerText = 'Tambah Anggota Himpunan';
            document.getElementById('f-btn-text').innerText = 'Simpan Anggota';
            formModal.open();
        }

        function openEditModal(m) {
            resetForm();
            currentMode = 'edit';
            currentMemberId = m.id;
            document.getElementById('form-modal-title').innerText = 'Edit Data Anggota';
            document.getElementById('f-btn-text').innerText = 'Update Anggota';

            // Fill form
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

            formModal.open();
        }

        function resetForm() {
            document.getElementById('member-form').reset();
            document.getElementById('f-image-preview').src = '';
            document.getElementById('f-image-preview').classList.add('hidden');
            document.getElementById('f-image-placeholder').classList.remove('hidden');
            document.getElementById('f-image-input').value = '';

            // Reset Button State
            document.getElementById('f-submit-btn').disabled = false;

            croppedImageBlob = null;
            originalImageFile = null;
        }

        // --- Cropper Handling ---
        function handleImageSelect(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate size (10MB)
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

        function openCropper(imageSrc) {
            const cropperModal = document.getElementById('cropper-modal');
            const cropperImage = document.getElementById('cropper-image');

            cropperImage.src = imageSrc;
            cropperModal.classList.remove('hidden');
            cropperModal.classList.add('flex');

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(cropperImage, {
                aspectRatio: 1, // Square for profiles
                viewMode: 1,
                autoCropArea: 0.8,
            });
        }

        function cancelCrop() {
            document.getElementById('cropper-modal').classList.add('hidden');
            document.getElementById('cropper-modal').classList.remove('flex');
            document.getElementById('f-image-input').value = ''; // Reset input
            if (cropper) cropper.destroy();
        }

        function applyCrop() {
            if (!cropper) return;

            cropper.getCroppedCanvas({
                width: 500, // Reasonable size for profile
                height: 500,
            }).toBlob((blob) => {
                croppedImageBlob = blob;

                // Show preview
                const url = URL.createObjectURL(blob);
                const preview = document.getElementById('f-image-preview');
                preview.src = url;
                preview.classList.remove('hidden');
                document.getElementById('f-image-placeholder').classList.add('hidden');

                // Close cropper
                document.getElementById('cropper-modal').classList.add('hidden');
                document.getElementById('cropper-modal').classList.remove('flex');
                if (cropper) cropper.destroy();

            }, 'image/jpeg', 0.9);
        }

        // --- AJAX Form Submission ---
        async function submitForm() {
            const btn = document.getElementById('f-submit-btn');
            const text = document.getElementById('f-btn-text');

            // Basic Validation
            const name = document.getElementById('f-name').value;
            const position = document.getElementById('f-position_id').value;
            const order = document.getElementById('f-order').value;

            if (!name || !position || !order) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data tidak lengkap',
                    text: 'Mohon isi Nama, Jabatan, dan Urutan.',
                    confirmButtonColor: '#0f172a'
                });
                return;
            }

            // Prepare Data
            const formData = new FormData();
            formData.append('name', name);
            formData.append('npm', document.getElementById('f-npm').value);
            formData.append('position_id', position);
            formData.append('division_id', document.getElementById('f-division_id').value || '');
            formData.append('order', order);
            formData.append('instagram_url', document.getElementById('f-instagram_url').value);
            formData.append('linkedin_url', document.getElementById('f-linkedin_url').value);
            formData.append('_token', '{{ csrf_token() }}');

            // Append Image
            if (croppedImageBlob) {
                formData.append('image', croppedImageBlob, 'profile.jpg');
            }

            // Determine URL and Method
            let url = "{{ route('admin.members.store') }}";
            let method = 'POST';

            if (currentMode === 'edit') {
                url = `/admin/members/${currentMemberId}`; // We used POST update in step 26
            }

            // UI Loading
            btn.disabled = true;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Force JSON response if needed
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Terjadi kesalahan saat menyimpan data.');
                }

                // Success
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data anggota telah disimpan.',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });

            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan',
                    text: error.message,
                    confirmButtonColor: '#0f172a'
                });
                btn.disabled = false;
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
                    popup: 'rounded-xl border border-slate-200 shadow-xl font-sans',
                    confirmButton: 'px-4 py-2 rounded-lg font-medium text-sm',
                    cancelButton: 'px-4 py-2 rounded-lg font-medium text-sm text-slate-600'
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
                    popup: 'rounded-lg border border-slate-100 shadow-lg'
                }
            });
        @endif
    </script>
@endsection
