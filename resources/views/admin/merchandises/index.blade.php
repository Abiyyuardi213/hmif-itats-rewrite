@extends('layouts.admin')

@section('title', 'Manajemen Merchandise')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <span class="hover:text-slate-600 transition-colors">Admin</span>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Merchandise</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Merchandise</h1>
                <p class="text-sm text-slate-500">Kelola produk merchandise HMIF ITATS.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                <i class="fas fa-plus mr-2 text-[10px]"></i>
                Tambah Produk
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Produk</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $merchandises->count() }}</p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tersedia</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight text-emerald-600">
                    {{ $merchandises->where('is_available', true)->count() }}
                </p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Stok</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight text-blue-600">
                    {{ $merchandises->sum('stock') }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/30">
                <div class="relative max-w-sm">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="search" onkeyup="filterTable()" placeholder="Cari produk..."
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md bg-white text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Stok</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($merchandises as $m)
                            <tr class="group hover:bg-slate-50/40 transition-colors merchandise-row">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-md bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0">
                                            @if ($m->image)
                                                <img src="{{ asset('storage/' . $m->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <i class="fas fa-tshirt"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <span
                                                class="font-semibold text-slate-900 search-name block">{{ $m->name }}</span>
                                            @if ($m->category)
                                                <span
                                                    class="text-[10px] text-slate-400 uppercase">{{ $m->category }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    Rp {{ number_format($m->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold {{ $m->stock > 10 ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : ($m->stock > 0 ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-rose-50 text-rose-700 border border-rose-100') }}">
                                        {{ $m->stock }} Unit
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($m->is_available)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100">Tersedia</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-slate-100 text-slate-500 border border-slate-200">Tidak
                                            Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick='openEditModal(@json($m))'
                                            class="p-1.5 text-slate-400 hover:text-blue-600 rounded-md hover:bg-slate-100 transition-colors">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $m->id }}, '{{ $m->name }}')"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-colors">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">Belum ada produk
                                    merchandise.</td>
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
            class="relative bg-white w-full max-w-2xl rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200 my-8">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 id="modal-title" class="font-semibold text-slate-900">Tambah Produk</h3>
                <button onclick="closeModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="merchandise-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5 md:col-span-2">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama Produk <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="f-name" required placeholder="Nama produk..."
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Kategori</label>
                        <select name="category" id="f-category"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:ring-2 focus:ring-slate-900/5 transition-all">
                            <option value="">Pilih Kategori</option>
                            <option value="T-Shirt">T-Shirt</option>
                            <option value="Hoodie">Hoodie</option>
                            <option value="Jacket">Jacket</option>
                            <option value="Sticker">Sticker</option>
                            <option value="Totebag">Totebag</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Harga <span
                                class="text-rose-500">*</span></label>
                        <input type="number" name="price" id="f-price" required min="0" step="1000"
                            placeholder="50000"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Stok <span
                                class="text-rose-500">*</span></label>
                        <input type="number" name="stock" id="f-stock" required min="0" placeholder="100"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Ukuran
                            Tersedia</label>
                        <div class="flex flex-wrap gap-2 pt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="sizes[]" value="S"
                                    class="rounded border-slate-300 text-slate-900 focus:ring-slate-900/5">
                                <span class="ml-2 text-sm">S</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="sizes[]" value="M"
                                    class="rounded border-slate-300 text-slate-900 focus:ring-slate-900/5">
                                <span class="ml-2 text-sm">M</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="sizes[]" value="L"
                                    class="rounded border-slate-300 text-slate-900 focus:ring-slate-900/5">
                                <span class="ml-2 text-sm">L</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="sizes[]" value="XL"
                                    class="rounded border-slate-300 text-slate-900 focus:ring-slate-900/5">
                                <span class="ml-2 text-sm">XL</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="sizes[]" value="XXL"
                                    class="rounded border-slate-300 text-slate-900 focus:ring-slate-900/5">
                                <span class="ml-2 text-sm">XXL</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-1.5 md:col-span-2">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Deskripsi <span
                                class="text-rose-500">*</span></label>
                        <textarea name="description" id="f-description" rows="4" required placeholder="Deskripsi produk..."
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 transition-all resize-none"></textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Gambar Produk</label>
                        <input type="file" name="image" id="f-image" accept="image/*"
                            class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-slate-100 hover:file:bg-slate-200 transition-all">
                        <p class="text-[10px] text-slate-400">PNG, JPG, GIF (Max. 2MB)</p>
                    </div>

                    <div class="flex items-center space-x-3 pt-6">
                        <input type="checkbox" name="is_available" id="f-is_available" value="1" checked
                            class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900/5">
                        <label for="f-is_available" class="text-sm font-medium text-slate-700">Tersedia untuk
                            dijual</label>
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

    <script>
        function filterTable() {
            const input = document.getElementById("search");
            const filter = input.value.toUpperCase();
            const rows = document.getElementsByClassName("merchandise-row");

            for (let i = 0; i < rows.length; i++) {
                const name = rows[i].getElementsByClassName("search-name")[0].innerText.toUpperCase();
                rows[i].style.display = name.includes(filter) ? "" : "none";
            }
        }

        const modalRoot = document.getElementById('modal-root');
        const modalOverlay = document.getElementById('modal-overlay');
        const modalContent = document.getElementById('modal-content');

        function openModal() {
            modalRoot.classList.remove('hidden');
            modalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
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
                document.getElementById('merchandise-form').reset();
            }, 200);
        }

        function openCreateModal() {
            const form = document.getElementById('merchandise-form');
            form.action = "{{ route('admin.merchandises.store') }}";
            document.getElementById('form-method').value = 'POST';
            document.getElementById('modal-title').innerText = 'Tambah Produk Baru';
            document.getElementById('submit-btn').innerText = 'Simpan';
            openModal();
        }

        function openEditModal(m) {
            const form = document.getElementById('merchandise-form');
            form.action = `/admin/merchandises/${m.id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('modal-title').innerText = 'Edit Produk';
            document.getElementById('submit-btn').innerText = 'Update';

            document.getElementById('f-name').value = m.name;
            document.getElementById('f-category').value = m.category || '';
            document.getElementById('f-price').value = m.price;
            document.getElementById('f-stock').value = m.stock;
            document.getElementById('f-description').value = m.description;
            document.getElementById('f-is_available').checked = m.is_available;

            // Check sizes
            document.querySelectorAll('input[name="sizes[]"]').forEach(checkbox => {
                checkbox.checked = m.sizes && m.sizes.includes(checkbox.value);
            });

            openModal();
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus produk?',
                text: `"${name}" akan dihapus permanen.`,
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
                    form.action = `/admin/merchandises/${id}`;
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
