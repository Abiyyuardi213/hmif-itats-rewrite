@extends('layouts.admin')

@section('title', 'Metode Pembayaran')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Metode Pembayaran</h1>
                <p class="text-sm text-slate-500">Kelola rekening bank dan e-wallet untuk pembayaran merchandise.</p>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                <i class="fas fa-plus mr-2 text-[10px]"></i>
                Tambah Metode
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Nama
                                Bank/Wallet</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Detail Akun
                            </th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Tipe</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-center">
                                Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($paymentMethods as $pm)
                            <tr class="group hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($pm->logo)
                                            <div
                                                class="w-8 h-8 rounded-md bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200">
                                                <img src="{{ asset('storage/' . $pm->logo) }}" alt="{{ $pm->name }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div
                                                class="w-8 h-8 rounded-md bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                        @endif
                                        <span class="font-semibold text-slate-900 text-sm">{{ $pm->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-mono font-medium text-slate-700">{{ $pm->account_number }}</span>
                                        <span class="text-xs text-slate-500">a.n {{ $pm->account_holder }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide border {{ $pm->type == 'bank' ? 'bg-blue-50 text-blue-700 border-blue-200' : ($pm->type == 'ewallet' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-purple-50 text-purple-700 border-purple-200') }}">
                                        {{ $pm->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($pm->is_active)
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase">Aktif</span>
                                    @else
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full bg-slate-50 text-slate-500 border border-slate-200 text-[10px] font-bold uppercase">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick='openEditModal(@json($pm))'
                                            class="p-1.5 text-slate-400 hover:text-blue-600 rounded-md hover:bg-slate-100 transition-all">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $pm->id }}, '{{ $pm->name }}')"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-all">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                    Belum ada metode pembayaran yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="modal-container" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="modal-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeModal()"></div>

        <div id="modal-content"
            class="relative bg-white w-full max-w-md rounded-lg shadow-xl hidden transform scale-95 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 id="form-title" class="font-semibold text-slate-900">Tambah Metode Pembayaran</h3>
                <button onclick="closeModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <form id="pm-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Nama Metode <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="name" id="f-name" required placeholder="E.g. Bank Mandiri"
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Nomor Rekening/Akun <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="account_number" id="f-account_number" required placeholder="E.g. 1234567890"
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Atas Nama <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="account_holder" id="f-account_holder" required placeholder="E.g. HMIF ITATS"
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Tipe <span
                                class="text-rose-500">*</span></label>
                        <select name="type" id="f-type" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                            <option value="bank">Bank Transfer</option>
                            <option value="ewallet">E-Wallet</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Status</label>
                        <div class="flex items-center gap-2 mt-2">
                            <input type="checkbox" name="is_active" id="f-is_active" value="1"
                                class="w-4 h-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
                            <span class="text-sm text-slate-600">Aktif</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Deskripsi/Instruksi</label>
                    <textarea name="description" id="f-description" rows="2" placeholder="Instruksi transfer..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all resize-none"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Logo (Opsional)</label>
                    <input type="file" name="logo" id="f-logo" accept="image/*"
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

    <script>
        const modalContainer = document.getElementById('modal-container');
        const modalOverlay = document.getElementById('modal-overlay');
        const modalContent = document.getElementById('modal-content');

        function toggleModal(show) {
            if (show) {
                modalContainer.classList.remove('hidden');
                modalContainer.classList.add('flex');
                modalContent.classList.remove('hidden');
                setTimeout(() => {
                    modalOverlay.classList.remove('opacity-0');
                    modalOverlay.classList.add('opacity-100');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                modalOverlay.classList.remove('opacity-100');
                modalOverlay.classList.add('opacity-0');
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modalContainer.classList.add('hidden');
                    modalContainer.classList.remove('flex');
                    modalContent.classList.add('hidden');
                }, 200);
            }
        }

        function openCreateModal() {
            const form = document.getElementById('pm-form');
            form.action = "{{ route('admin.payment-methods.store') }}";
            document.getElementById('form-method').value = 'POST';
            document.getElementById('form-title').innerText = 'Tambah Metode Pembayaran';
            form.reset();
            document.getElementById('f-is_active').checked = true;
            toggleModal(true);
        }

        function openEditModal(pm) {
            const form = document.getElementById('pm-form');
            form.action = `/admin/payment-methods/${pm.id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('form-title').innerText = 'Edit Metode Pembayaran';

            document.getElementById('f-name').value = pm.name;
            document.getElementById('f-account_number').value = pm.account_number;
            document.getElementById('f-account_holder').value = pm.account_holder;
            document.getElementById('f-type').value = pm.type;
            document.getElementById('f-description').value = pm.description || '';
            document.getElementById('f-is_active').checked = pm.is_active;

            toggleModal(true);
        }

        function closeModal() {
            toggleModal(false);
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus metode?',
                text: `Metode "${name}" akan dihapus permanen.`,
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
                    form.action = `/admin/payment-methods/${id}`;
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

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan',
                html: `
                    <ul class="text-left text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#0f172a',
                customClass: {
                    popup: 'rounded-lg border border-slate-200 shadow-xl',
                    confirmButton: 'px-4 py-2 rounded-md font-medium text-sm'
                }
            });
            // Re-open modal roughly if it was a create/edit attempt? 
            // It's hard to know which one without more state, but showing errors is the priority.
            // You could optionally: toggleModal(true); if you want to be aggressive.
        @endif
    </script>
@endsection
