@extends('layouts.admin')

@section('title', 'Kelola Pengurus - ' . $period->name)

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumbs & Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <a href="{{ route('admin.periods.index') }}" class="hover:text-slate-600 transition-colors">Periode / Kabinet</a>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">{{ $period->name }}</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pengurus {{ $period->name }}</h1>
                    <span class="px-3 py-0.5 rounded-full text-xs font-bold font-mono bg-slate-100 text-slate-700">
                        {{ $period->academic_year }}
                    </span>
                    @if($period->is_active)
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Kabinet Aktif
                        </span>
                    @endif
                </div>
                <p class="text-sm text-slate-500">Kelola susunan Ketua, Wakil, Sekretaris, Bendahara, Koor Divisi, dan Anggota Divisi khusus kabinet ini.</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.periods.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 bg-white text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
                    <i class="fas fa-arrow-left mr-2 text-[10px]"></i>
                    Kembali
                </a>
                <button onclick="openCreateModal()"
                    class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">
                    <i class="fas fa-plus mr-2 text-[10px]"></i>
                    Tambah Pengurus Kabinet
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pengurus</p>
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
                        <p class="text-2xl font-bold text-indigo-600 tracking-tight">{{ $totalInti }}</p>
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
                        <p class="text-2xl font-bold text-emerald-600 tracking-tight">{{ $totalStaff }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                <div class="relative max-w-sm w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="member-search" onkeyup="filterMembers()"
                        placeholder="Cari fungsionaris..."
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md bg-white text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/5 focus:border-slate-300 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Fungsionaris</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Jabatan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Divisi</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-center">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($members as $member)
                            <tr class="group hover:bg-slate-50/40 transition-colors member-row">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden ring-1 ring-slate-200 flex-shrink-0 relative">
                                            @if ($member->image)
                                                <img src="{{ asset('storage/' . $member->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <i class="fas fa-user text-lg"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-slate-900 search-name">{{ $member->name }}</span>
                                            <span class="text-[11px] text-slate-400 font-medium tracking-tight search-npm">{{ $member->npm ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-widest border search-position {{ optional($member->position)->type == 'inti' ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-slate-50 text-slate-600 border-slate-200' }}">
                                        {{ optional($member->position)->name ?? 'Pengurus' }}
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
                                        <span class="text-[11px] text-slate-300 italic search-division">Pengurus Inti</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <label class="relative inline-flex items-center cursor-pointer" title="Klik untuk ubah status">
                                        <input type="checkbox" onchange="toggleMemberStatus({{ $member->id }}, this)"
                                            {{ ($member->status ?? 'aktif') === 'aktif' ? 'checked' : '' }} class="sr-only peer">
                                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
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
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">
                                    Belum ada pengurus di {{ $period->name }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Modal -->
    <div id="form-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 overflow-y-auto">
        <div id="form-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeFormModal()"></div>
        <div id="form-content"
            class="relative bg-white w-full max-w-xl rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200 my-8">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 id="form-modal-title" class="font-semibold text-slate-900">Tambah Pengurus</h3>
                <button onclick="closeFormModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="member-form" action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="period_id" value="{{ $period->id }}">
                <input type="hidden" name="_method" id="form-method" value="POST">

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" id="f-name" required placeholder="Nama pengurus..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">NPM</label>
                    <input type="text" name="npm" id="f-npm" placeholder="Nomor Pokok Mahasiswa..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Jabatan <span class="text-rose-500">*</span></label>
                        <select name="position_id" id="f-position_id" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Divisi</label>
                        <select name="division_id" id="f-division_id"
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                            <option value="">Tanpa Divisi (Inti)</option>
                            @foreach ($divisions as $div)
                                <option value="{{ $div->id }}">{{ $div->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Status Anggota <span class="text-rose-500">*</span></label>
                    <select name="status" id="f-status" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white font-semibold focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif / Demisioner</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Foto Profil</label>
                    <input type="file" name="image" id="f-image" accept="image/*"
                        class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-slate-100 hover:file:bg-slate-200 transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Instagram URL</label>
                        <input type="url" name="instagram_url" id="f-instagram_url" placeholder="https://instagram.com/..."
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" id="f-linkedin_url" placeholder="https://linkedin.com/in/..."
                            class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 transition-all">
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeFormModal()"
                        class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit" id="submit-btn"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="delete-form" method="POST" class="hidden">
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

                if (nameText.includes(filter) || npmText.includes(filter) || positionText.includes(filter) || divisionText.includes(filter)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        const formModalRoot = document.getElementById('form-modal-root');
        const formOverlay = document.getElementById('form-overlay');
        const formContent = document.getElementById('form-content');

        function openFormModal() {
            formModalRoot.classList.remove('hidden');
            formModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                formOverlay.classList.replace('opacity-0', 'opacity-100');
                formContent.classList.remove('translate-y-4', 'opacity-0');
                formContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeFormModal() {
            formOverlay.classList.replace('opacity-100', 'opacity-0');
            formContent.classList.replace('translate-y-0', 'opacity-100');
            formContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                formModalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
                document.getElementById('member-form').reset();
            }, 200);
        }

        function openCreateModal() {
            const form = document.getElementById('member-form');
            form.action = "{{ route('admin.members.store') }}";
            document.getElementById('form-method').value = 'POST';
            document.getElementById('form-modal-title').innerText = 'Tambah Pengurus {{ $period->name }}';
            document.getElementById('submit-btn').innerText = 'Simpan';
            document.getElementById('f-status').value = 'aktif';
            openFormModal();
        }

        function openEditModal(m) {
            const form = document.getElementById('member-form');
            form.action = `/admin/members/${m.id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('form-modal-title').innerText = 'Edit Pengurus';
            document.getElementById('submit-btn').innerText = 'Update';

            document.getElementById('f-name').value = m.name || '';
            document.getElementById('f-npm').value = m.npm || '';
            document.getElementById('f-position_id').value = m.position_id || '';
            document.getElementById('f-division_id').value = m.division_id || '';
            document.getElementById('f-status').value = m.status || 'aktif';
            document.getElementById('f-instagram_url').value = m.instagram_url || '';
            document.getElementById('f-linkedin_url').value = m.linkedin_url || '';

            openFormModal();
        }

        function toggleMemberStatus(id, checkbox) {
            fetch(`/admin/members/${id}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    checkbox.checked = !checkbox.checked;
                    Swal.fire('Error', 'Gagal mengubah status', 'error');
                }
            })
            .catch(err => {
                checkbox.checked = !checkbox.checked;
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
            });
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus pengurus?',
                text: `"${name}" akan dihapus dari {{ $period->name }}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-lg border border-slate-200 shadow-xl',
                    confirmButton: 'px-6 py-3 rounded-xl font-bold text-sm',
                    cancelButton: 'px-6 py-3 rounded-xl font-bold text-sm text-slate-600'
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
