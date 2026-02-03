@extends('layouts.admin')

@section('title', 'Manajemen Pengumuman')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <span class="hover:text-slate-600 transition-colors">Admin</span>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Pengumuman</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pengumuman</h1>
                <p class="text-sm text-slate-500">Kelola informasi dan berita terbaru untuk mahasiswa.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                <i class="fas fa-plus mr-2 text-[10px]"></i>
                Buat Pengumuman
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $announcements->count() }}</p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Published</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight text-emerald-600">
                    {{ $announcements->where('is_published', true)->count() }}
                </p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Draft</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight text-amber-600">
                    {{ $announcements->where('is_published', false)->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/30">
                <div class="relative max-w-sm">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="search" onkeyup="filterTable()" placeholder="Cari judul..."
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md bg-white text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($announcements as $a)
                            <tr class="group hover:bg-slate-50/40 transition-colors announcement-row">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-md bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0">
                                            @if ($a->image)
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <i class="fas fa-bullhorn"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="font-semibold text-slate-900 search-title">{{ $a->title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($a->is_published)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100">Published</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-slate-100 text-slate-500 border border-slate-200">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-medium">
                                    {{ $a->published_at ? $a->published_at->format('d M Y') : $a->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick='openEditModal(@json($a))'
                                            class="p-1.5 text-slate-400 hover:text-blue-600 rounded-md hover:bg-slate-100 transition-colors">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $a->id }}, '{{ $a->title }}')"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-colors">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">Belum ada
                                    pengumuman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Modal -->
    <div id="modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="modal-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeModal()"></div>
        <div id="modal-content"
            class="relative bg-white w-full max-w-4xl rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200 my-8">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 id="modal-title" class="font-semibold text-slate-900">Buat Pengumuman</h3>
                <button onclick="closeModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="announcement-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                <input type="hidden" name="content" id="hidden-content">

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Judul Pengumuman <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="f-title" required placeholder="Judul pengumuman..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Konten Pengumuman <span
                            class="text-rose-500">*</span></label>
                    <div class="border border-slate-200 rounded-md overflow-hidden bg-white">
                        <div id="toolbar" class="bg-slate-50 border-b border-slate-200">
                            <span class="ql-formats">
                                <select class="ql-header">
                                    <option value="1">Heading 1</option>
                                    <option value="2">Heading 2</option>
                                    <option value="3">Heading 3</option>
                                    <option selected>Normal</option>
                                </select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="editor" class="bg-white" style="min-height: 300px;"></div>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Gunakan toolbar di atas untuk memformat konten pengumuman
                        Anda</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Gambar
                            Unggulan</label>
                        <input type="file" name="image" id="f-image" accept="image/*"
                            class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-slate-100 hover:file:bg-slate-200 transition-all tracking-tight">
                        <p class="text-[10px] text-slate-400">PNG, JPG, GIF (Max. 2MB)</p>
                    </div>
                    <div class="flex items-center space-x-3 pt-6">
                        <input type="checkbox" name="is_published" id="f-is_published" value="1"
                            class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900/5 transition-all">
                        <label for="f-is_published" class="text-sm font-medium text-slate-700">Publish sekarang</label>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit" id="submit-btn"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        let quill;

        // Initialize Quill Editor
        function initQuill() {
            quill = new Quill('#editor', {
                modules: {
                    toolbar: '#toolbar'
                },
                theme: 'snow',
                placeholder: 'Tulis konten pengumuman di sini...'
            });
        }

        function filterTable() {
            const input = document.getElementById("search");
            const filter = input.value.toUpperCase();
            const rows = document.getElementsByClassName("announcement-row");

            for (let i = 0; i < rows.length; i++) {
                const title = rows[i].getElementsByClassName("search-title")[0].innerText.toUpperCase();
                rows[i].style.display = title.includes(filter) ? "" : "none";
            }
        }

        const modalRoot = document.getElementById('modal-root');
        const modalOverlay = document.getElementById('modal-overlay');
        const modalContent = document.getElementById('modal-content');

        function openModal() {
            modalRoot.classList.remove('hidden');
            modalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';

            // Initialize Quill if not already initialized
            if (!quill) {
                initQuill();
            }

            setTimeout(() => {
                modalOverlay.classList.replace('opacity-0', 'opacity-100');
                modalContent.classList.remove('translate-y-4', 'opacity-0');
                modalContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalOverlay.classList.replace('opacity-100', 'opacity-0');
            modalContent.classList.replace('translate-y-0', 'opacity-100');
            modalContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                modalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
                document.getElementById('announcement-form').reset();
                if (quill) {
                    quill.setContents([]);
                }
            }, 200);
        }

        function openCreateModal() {
            const form = document.getElementById('announcement-form');
            form.action = "{{ route('admin.announcements.store') }}";
            document.getElementById('form-method').value = 'POST';
            document.getElementById('modal-title').innerText = 'Buat Pengumuman Baru';
            document.getElementById('submit-btn').innerText = 'Simpan';

            if (quill) {
                quill.setContents([]);
            }

            openModal();
        }

        function openEditModal(a) {
            const form = document.getElementById('announcement-form');
            form.action = `/admin/announcements/${a.id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('modal-title').innerText = 'Edit Pengumuman';
            document.getElementById('submit-btn').innerText = 'Update';

            document.getElementById('f-title').value = a.title;
            document.getElementById('f-is_published').checked = a.is_published;

            openModal();

            // Set Quill content after modal is opened
            setTimeout(() => {
                if (quill && a.content) {
                    quill.root.innerHTML = a.content;
                }
            }, 100);
        }

        // Before form submit, copy Quill content to hidden input
        document.getElementById('announcement-form').addEventListener('submit', function(e) {
            if (quill) {
                const content = quill.root.innerHTML;
                document.getElementById('hidden-content').value = content;
            }
        });

        function confirmDelete(id, title) {
            Swal.fire({
                title: 'Hapus pengumuman?',
                text: `"${title}" akan dihapus permanen.`,
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
            }).then((r) => {
                if (r.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = `/admin/announcements/${id}`;
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
