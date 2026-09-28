<div x-data="{ sidebarOpen: true }">
    <!-- Floating Detached Sidebar (Permanent on Desktop, Collapsible on Mobile) -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed top-5 left-5 bottom-5 z-40 w-64 bg-white/95 backdrop-blur-xl border border-slate-200/80 shadow-xl rounded-3xl flex flex-col justify-between transition-all duration-300 overflow-hidden">
        
        <!-- Sidebar Brand Header -->
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('image/hima-infor.png') }}" alt="HMIF Logo" class="w-9 h-9 object-contain">
                <div class="flex flex-col">
                    <span class="font-bold text-sm leading-tight text-slate-900 tracking-tight">Admin System</span>
                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">HMIF ITATS</span>
                </div>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-900 p-1">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <!-- Sidebar Navigation Items (Scrollable) -->
        <div class="p-3.5 space-y-1 overflow-y-auto flex-1 custom-scrollbar">
            <!-- Main Section -->
            <a href="{{ url('/admin/dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-2xl text-xs font-bold transition-all {{ request()->is('admin/dashboard') ? 'bg-slate-900 text-white shadow-md shadow-slate-900/10' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-chart-pie text-sm {{ request()->is('admin/dashboard') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Dashboard</span>
            </a>

            <!-- Structure Section -->
            <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Struktur Organisasi</div>
            <a href="{{ route('admin.periods.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/periods*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-layer-group text-xs {{ request()->is('admin/periods*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Periode Kabinet</span>
            </a>
            <a href="{{ route('admin.positions.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/positions*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-id-badge text-xs {{ request()->is('admin/positions*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Jabatan</span>
            </a>
            <a href="{{ route('admin.divisions.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/divisions*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-sitemap text-xs {{ request()->is('admin/divisions*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Divisi</span>
            </a>
            <a href="{{ route('admin.members.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/members*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-users text-xs {{ request()->is('admin/members*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Anggota Himpunan</span>
            </a>

            <!-- Program & Content -->
            <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Program & Artikel</div>
            <a href="{{ route('admin.work-programs.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/work-programs*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-tasks text-xs {{ request()->is('admin/work-programs*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Program Kerja</span>
            </a>
            <a href="{{ route('admin.activity-reports.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/activity-reports*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-newspaper text-xs {{ request()->is('admin/activity-reports*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Artikel & Berita</span>
            </a>
            <a href="{{ route('admin.about-pages.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/about-pages*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-file-alt text-xs {{ request()->is('admin/about-pages*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Halaman Profil</span>
            </a>
            <a href="{{ route('admin.announcements.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/announcements*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-bullhorn text-xs {{ request()->is('admin/announcements*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Pengumuman</span>
            </a>

            <!-- Pemilu Cakahim -->
            <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Pemilu Cakahim</div>
            <a href="{{ route('admin.voting-schedules.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/voting-schedules*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-calendar-alt text-xs {{ request()->is('admin/voting-schedules*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Jadwal Pemilu</span>
            </a>
            <a href="{{ route('admin.candidates.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/candidates*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-users-cog text-xs {{ request()->is('admin/candidates*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Calon Cakahim</span>
            </a>
            <a href="{{ route('admin.votes.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/votes*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-list-check text-xs {{ request()->is('admin/votes*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Daftar Pemilih</span>
            </a>

            <!-- Store & Access -->
            <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Store & Hak Akses</div>
            <a href="{{ route('admin.merchandises.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/merchandises*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-box text-xs {{ request()->is('admin/merchandises*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Daftar Produk</span>
            </a>
            <a href="{{ route('admin.merchandise-orders.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/merchandise-orders*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-shopping-cart text-xs {{ request()->is('admin/merchandise-orders*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>Pesanan Merchandise</span>
            </a>
            <a href="{{ url('/admin/users') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-2xl text-xs font-semibold transition-all {{ request()->is('admin/users*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                <i class="fas fa-user-shield text-xs {{ request()->is('admin/users*') ? 'text-pink-400' : 'text-slate-400' }}"></i>
                <span>User Admin</span>
            </a>
        </div>

        <!-- Sidebar Profile Footer -->
        <div class="p-3.5 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5 min-w-0 flex-1">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0f172a&color=fff&bold=true"
                    class="w-8 h-8 rounded-xl object-cover flex-shrink-0">
                <div class="flex flex-col min-w-0 flex-1">
                    <span class="text-xs font-bold text-slate-900 truncate">{{ Auth::user()->name }}</span>
                    <span class="text-[9px] text-slate-400 uppercase font-semibold truncate">{{ Auth::user()->role }}</span>
                </div>
            </div>
            <button onclick="confirmLogout()" class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition-colors flex-shrink-0" title="Logout">
                <i class="fas fa-sign-out-alt text-xs"></i>
            </button>
        </div>
    </aside>

    <!-- Top Action Controls -->
    <header class="absolute top-6 right-6 lg:right-8 z-30">
        <div class="flex items-center gap-3">
            <!-- Mobile Toggle -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden p-2.5 rounded-2xl bg-white/90 hover:bg-white text-slate-800 backdrop-blur-md shadow-sm border border-slate-200/60">
                <i class="fas fa-bars text-base"></i>
            </button>

            <a href="{{ url('/') }}" target="_blank"
                class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 bg-white/90 hover:bg-white text-slate-700 text-xs font-bold rounded-2xl backdrop-blur-md border border-slate-200/60 shadow-sm transition-all hover:text-slate-900">
                <i class="fas fa-external-link-alt text-[10px]"></i>
                <span>Lihat Website</span>
            </a>

            <button onclick="confirmLogout()"
                class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold rounded-2xl shadow-md shadow-rose-500/20 transition-all active:scale-95">
                <i class="fas fa-power-off text-xs"></i>
                <span>Keluar</span>
            </button>
        </div>
    </header>
</div>

<form id="logout-form" action="{{ url('/logout-admin') }}" method="POST" class="hidden">
    @csrf
</form>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: "Apakah Anda yakin ingin mengakhiri sesi admin?",
            icon: 'warning',
            iconColor: '#e11d48',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout Sekarang',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#f1f5f9',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-[1.5rem] border-none shadow-2xl',
                title: 'text-xl font-bold text-slate-900',
                htmlContainer: 'text-slate-500 text-sm',
                confirmButton: 'px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-rose-600/20 focus:ring-0',
                cancelButton: 'px-6 py-3 rounded-xl font-bold text-sm !text-slate-900 border border-slate-200 focus:ring-0'
            },
            buttonsStyling: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
