@extends('layouts.admin')

@section('title', 'Manajemen Program Kerja')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Program Kerja</h1>
                <p class="text-sm text-slate-500">Kelola dan pantau seluruh program kegiatan organisasi.</p>
            </div>

            <div class="hidden md:flex items-center gap-4">
                <div class="px-4 py-2 bg-white border border-slate-200 rounded-lg shadow-sm">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">Total Program</p>
                    <p class="text-lg font-bold text-slate-900 leading-none">{{ count($programs) }}</p>
                </div>
            </div>
            <button onclick="openCreateModal()"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                <i class="fas fa-plus mr-2 text-[10px]"></i>
                Tambah Proker
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <!-- Filter & Search -->
            <div class="p-4 border-b border-slate-100 bg-slate-50/30">
                <div class="relative max-w-xs">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-slate-400 text-xs"></i>
                    </span>
                    <input type="text" id="table-search" onkeyup="filterTable()" placeholder="Cari program..."
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md bg-white text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-300 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="proker-table">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Program</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Divisi</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-center">
                                Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($programs as $program)
                            <tr class="group hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-semibold text-slate-900 text-sm program-name">{{ $program->name }}</span>
                                        <span class="text-xs text-slate-400 mt-0.5">
                                            {{ $program->start_date ? \Carbon\Carbon::parse($program->start_date)->format('d M Y') : 'TBA' }}
                                            @if ($program->location)
                                                • {{ $program->location }}
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs font-medium text-slate-600 px-2 py-0.5 rounded-md bg-slate-100 border border-slate-200">
                                        {{ $program->division->name ?? 'General' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center text-xs">
                                    @php
                                        $badges = [
                                            'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'berjalan' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'mendatang' => 'bg-slate-50 text-slate-600 border-slate-200',
                                        ];
                                        $badgeClass = $badges[$program->status] ?? $badges['mendatang'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full font-semibold border capitalize {{ $badgeClass }}">
                                        {{ $program->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick='openDetailModal(@json($program))'
                                            class="p-1.5 text-slate-400 hover:text-slate-900 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                        <button onclick='openEditModal(@json($program))'
                                            class="p-1.5 text-slate-400 hover:text-blue-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $program->id }}, '{{ $program->name }}')"
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
                                    <p class="text-slate-400 text-sm italic">Belum ada data program kerja.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modals (Shared logic) -->
    <div id="modal-container" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="modal-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeAllModals()"></div>

        <!-- Detail Modal Content -->
        <div id="detail-content"
            class="relative bg-white w-full max-w-lg rounded-lg shadow-xl hidden transform scale-95 opacity-0 transition-all duration-200 overflow-hidden border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Detail Kegiatan</h3>
                <button onclick="closeAllModals()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <div class="p-6 space-y-4 text-sm">
                <div id="d-status-badge" class="mb-2"></div>
                <h2 id="d-title" class="text-xl font-bold text-slate-900"></h2>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Divisi Pelaksana</p>
                        <p id="d-division" class="font-medium text-slate-700"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Lokasi / Media</p>
                        <p id="d-location" class="font-medium text-slate-700"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Timeline</p>
                        <p id="d-date" class="font-medium text-slate-700"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Ketua Pelaksana</p>
                        <p id="d-head" class="font-medium text-slate-700"></p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 pt-2 border-t border-slate-100">
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Peserta</p>
                        <p id="d-participants" class="text-base font-bold text-slate-900">0</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Anggaran</p>
                        <p id="d-budget" class="text-base font-bold text-slate-900">-</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Panitia</p>
                        <p id="d-team" class="text-base font-bold text-slate-900">0</p>
                    </div>
                </div>

                <div class="space-y-1 pt-2">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Deskripsi Kegiatan</p>
                    <div class="p-3 bg-slate-50 rounded-md border border-slate-200">
                        <p id="d-description" class="text-slate-600 leading-relaxed whitespace-pre-wrap"></p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 text-right">
                <button onclick="closeAllModals()"
                    class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors">Tutup</button>
            </div>
        </div>

        <!-- Form Modal Content -->
        <div id="form-content"
            class="relative bg-white w-full max-w-xl rounded-lg shadow-xl hidden transform scale-95 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 id="form-title" class="font-semibold text-slate-900">Kelola Program</h3>
                <button onclick="closeAllModals()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="proker-form" method="POST" class="p-6 space-y-4 overflow-y-auto max-h-[70vh]">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2 space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Nama Program <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="f-name" required placeholder="E.g. Infor-Care 2024"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Divisi <span
                                class="text-rose-500">*</span></label>
                        <select name="division_id" id="f-division_id" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisions as $div)
                                <option value="{{ $div->id }}">{{ $div->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Status <span
                                class="text-rose-500">*</span></label>
                        <select name="status" id="f-status" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                            <option value="mendatang">Mendatang</option>
                            <option value="berjalan">Berjalan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="f-start_date"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="f-end_date"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Lokasi / Platform</label>
                        <input type="text" name="location" id="f-location" placeholder="E.g. Ruang L.302"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Ketua Pelaksana</label>
                        <select name="head_id" id="f-head_id"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                            <option value="">Pilih Member</option>
                            @foreach ($members as $m)
                                <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-3 gap-4 md:col-span-2">
                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Peserta</label>
                            <input type="number" name="participants_count" id="f-participants_count" min="0"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Anggaran</label>
                            <input type="text" name="budget" id="f-budget" placeholder="500.000"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Panitia</label>
                            <input type="number" name="team_count" id="f-team_count" min="0"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700">Deskripsi</label>
                        <textarea name="description" id="f-description" rows="3"
                            placeholder="Jelaskan secara singkat mengenai program ini..."
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all resize-none"></textarea>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeAllModals()"
                        class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Simpan
                        Program</button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-form" method="POST" class="hidden">@csrf @method('DELETE')</form>

    <script>
        function filterTable() {
            const input = document.getElementById("table-search");
            const filter = input.value.toUpperCase();
            const table = document.getElementById("proker-table");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByClassName("program-name")[0];
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }

        const modalContainer = document.getElementById('modal-container');
        const modalOverlay = document.getElementById('modal-overlay');
        const detailContent = document.getElementById('detail-content');
        const formContent = document.getElementById('form-content');

        function toggleModal(type, show = true) {
            if (show) {
                modalContainer.classList.remove('hidden');
                modalContainer.classList.add('flex');
                document.body.style.overflow = 'hidden';

                const content = type === 'detail' ? detailContent : formContent;
                content.classList.remove('hidden');

                setTimeout(() => {
                    modalOverlay.classList.remove('opacity-0');
                    modalOverlay.classList.add('opacity-100');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                modalOverlay.classList.remove('opacity-100');
                modalOverlay.classList.add('opacity-0');
                [detailContent, formContent].forEach(c => {
                    c.classList.remove('scale-100', 'opacity-100');
                    c.classList.add('scale-95', 'opacity-0');
                });

                setTimeout(() => {
                    modalContainer.classList.add('hidden');
                    modalContainer.classList.remove('flex');
                    [detailContent, formContent].forEach(c => c.classList.add('hidden'));
                    document.body.style.overflow = 'auto';
                }, 200);
            }
        }

        function openDetailModal(p) {
            document.getElementById('d-title').innerText = p.name;
            document.getElementById('d-division').innerText = p.division ? p.division.name : 'Umum';
            document.getElementById('d-location').innerText = p.location || '-';
            document.getElementById('d-date').innerText = p.start_date ? new Date(p.start_date).toLocaleDateString(
                'id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }) : '-';
            document.getElementById('d-head').innerText = p.head ? p.head.name : '-';
            document.getElementById('d-participants').innerText = p.participants_count || 0;
            document.getElementById('d-budget').innerText = p.budget || '-';
            document.getElementById('d-team').innerText = p.team_count || 0;
            document.getElementById('d-description').innerText = p.description || 'Tidak ada deskripsi.';

            const badges = {
                'selesai': 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'berjalan': 'bg-blue-50 text-blue-700 border-blue-200',
                'mendatang': 'bg-slate-50 text-slate-600 border-slate-200'
            };
            document.getElementById('d-status-badge').innerHTML =
                `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border ${badges[p.status] || badges.mendatang}">${p.status}</span>`;

            toggleModal('detail');
        }

        function openCreateModal() {
            const form = document.getElementById('proker-form');
            form.action = "{{ route('admin.work-programs.store') }}";
            document.getElementById('form-method').value = 'POST';
            document.getElementById('form-title').innerText = 'Tambah Program Baru';
            form.reset();
            toggleModal('form');
        }

        function openEditModal(p) {
            const form = document.getElementById('proker-form');
            form.action = `/admin/work-programs/${p.id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('form-title').innerText = 'Edit Program';

            document.getElementById('f-name').value = p.name || '';
            document.getElementById('f-division_id').value = p.division_id || '';
            document.getElementById('f-status').value = p.status || 'mendatang';
            document.getElementById('f-start_date').value = p.start_date || '';
            document.getElementById('f-end_date').value = p.end_date || '';
            document.getElementById('f-location').value = p.location || '';
            document.getElementById('f-head_id').value = p.head_id || '';
            document.getElementById('f-participants_count').value = p.participants_count || 0;
            document.getElementById('f-budget').value = p.budget || '';
            document.getElementById('f-team_count').value = p.team_count || 0;
            document.getElementById('f-description').value = p.description || '';

            toggleModal('form');
        }

        function closeAllModals() {
            toggleModal(null, false);
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus program?',
                text: `Program "${name}" akan dihapus permanen.`,
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
                    form.action = `/admin/work-programs/${id}`;
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
