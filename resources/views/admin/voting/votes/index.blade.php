@extends('layouts.admin')

@section('title', 'Daftar Pemilih & Riwayat Vote')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <a href="{{ route('admin.voting-schedules.index') }}" class="hover:text-slate-600 transition-colors">Jadwal Pemilu</a>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Daftar Pemilih</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Pemilih & Riwayat Voting</h1>
                <p class="text-sm text-slate-500">Pantau data pemilih (Dosen & Mahasiswa) yang telah memberikan hak suara pada sesi E-Voting Pemilu Cakahim.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.candidates.index', ['schedule_id' => $selectedScheduleId]) }}"
                    class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 bg-white text-slate-700 rounded-md text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
                    <i class="fas fa-users-cog mr-2 text-xs"></i>
                    Lihat Paslon Cakahim
                </a>
            </div>
        </div>

        <!-- Filter & Stats Bar -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <!-- Stats Widgets -->
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pemilih</p>
                    <p class="text-2xl font-black text-slate-900 mt-0.5">{{ $stats['total'] }} <span class="text-xs font-semibold text-slate-400">Orang</span></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                    <i class="fas fa-vote-yea text-base"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Suara Mahasiswa</p>
                    <p class="text-2xl font-black text-pink-600 mt-0.5">{{ $stats['mahasiswa'] }} <span class="text-xs font-semibold text-slate-400">Voter</span></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center font-bold">
                    <i class="fas fa-user-graduate text-base"></i>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Suara Dosen</p>
                    <p class="text-2xl font-black text-emerald-600 mt-0.5">{{ $stats['dosen'] }} <span class="text-xs font-semibold text-slate-400">Voter</span></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    <i class="fas fa-chalkboard-teacher text-base"></i>
                </div>
            </div>

            <!-- Schedule Select -->
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-center">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Sesi Pemilihan:</label>
                <select onchange="window.location.href='{{ route('admin.votes.index') }}?schedule_id=' + this.value"
                    class="w-full px-3 py-1.5 border border-slate-200 rounded-md text-xs font-bold text-slate-800 bg-white focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400">
                    @foreach($schedules as $s)
                        <option value="{{ $s->id }}" {{ $s->id == $selectedScheduleId ? 'selected' : '' }}>
                            {{ $s->title }} {{ $s->is_active ? '— (Aktif)' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Filter Search Bar -->
        <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
            <form method="GET" action="{{ route('admin.votes.index') }}" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
                <input type="hidden" name="schedule_id" value="{{ $selectedScheduleId }}">
                
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <select name="voter_type" onchange="this.form.submit()"
                        class="px-3 py-2 border border-slate-200 rounded-md text-xs font-semibold text-slate-700 bg-white">
                        <option value="">-- Semua Jenis Pemilih --</option>
                        <option value="mahasiswa" {{ $voterType == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="dosen" {{ $voterType == 'dosen' ? 'selected' : '' }}>Dosen</option>
                    </select>
                </div>

                <div class="relative w-full sm:w-80">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, NPM, atau email..."
                        class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-md text-xs text-slate-800 focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none">
                    <i class="fas fa-search absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                </div>
            </form>
        </div>

        <!-- Voters Table Card -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Nama Pemilih</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Status Pemilih</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">NPM / Identitas</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Pilihan Paslon</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight">Waktu Voting</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-tight text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($votes as $vote)
                            <tr class="group hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 font-bold text-xs flex items-center justify-center uppercase">
                                            {{ substr($vote->voter_name, 0, 2) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900">{{ $vote->voter_name }}</span>
                                            <span class="text-xs text-slate-400 font-mono">{{ $vote->voter_email ?? 'Tidak mengisi email' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($vote->voter_type === 'mahasiswa')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-700 border border-pink-100">
                                            <i class="fas fa-user-graduate text-[10px]"></i> Mahasiswa
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <i class="fas fa-chalkboard-teacher text-[10px]"></i> Dosen
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs text-slate-700 font-semibold bg-slate-100 px-2.5 py-1 rounded-md">
                                        {{ $vote->voter_npm ?? 'Dosen (Tanpa NPM)' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($vote->candidate)
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-md bg-slate-900 text-white font-bold text-[10px] flex items-center justify-center">
                                                0{{ $vote->candidate->candidate_number }}
                                            </span>
                                            <span class="font-bold text-slate-800 text-xs">{{ $vote->candidate->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Paslon terhapus</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-mono text-slate-500">
                                        <i class="far fa-clock text-[10px] mr-1 text-slate-400"></i>
                                        {{ $vote->created_at->format('d M Y, H:i:s') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button onclick="confirmDeleteVote({{ $vote->id }}, '{{ $vote->voter_name }}')"
                                        class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-colors"
                                        title="Hapus Vote">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic">
                                    Belum ada data pemilih / voting yang terekam pada sesi ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($votes->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $votes->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="delete-vote-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDeleteVote(id, name) {
            Swal.fire({
                title: 'Hapus Data Pemilih?',
                text: `Riwayat vote milik "${name}" akan dihapus dari sistem.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-vote-form');
                    form.action = `/admin/votes/${id}`;
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
                timerProgressBar: true
            });
        @endif
    </script>
@endsection
