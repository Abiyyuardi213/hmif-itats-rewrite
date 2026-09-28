<aside id="floating-sidebar"
    class="hidden lg:flex lg:flex-col fixed top-4 bottom-4 left-4 z-40 w-64 bg-slate-900 text-slate-200 border border-slate-800 rounded-2xl shadow-2xl transition-all duration-300">

    <!-- Sidebar Header / Logo -->
    <div class="p-5 border-b border-white/10 flex items-center justify-between">
        <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('image/hima-infor.png') }}" alt="HMIF Logo" class="w-8 h-8 object-contain">
            <div class="flex flex-col">
                <span class="font-bold text-sm leading-tight text-white tracking-tight">Admin System</span>
                <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">HMIF ITATS</span>
            </div>
        </a>
    </div>

    <!-- Sidebar Navigation Items -->
    <div class="flex-1 overflow-y-auto p-4 space-y-1.5 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
        <!-- Main Section -->
        <a href="{{ url('/admin/dashboard') }}"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->is('admin/dashboard') ? 'bg-pink-600 text-white shadow-md shadow-pink-600/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-chart-pie w-4 text-center"></i>
            <span>Dashboard</span>
        </a>

        <!-- Structure Section -->
        <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Struktur Organisasi</div>
        <a href="{{ route('admin.periods.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/periods*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-layer-group w-4 text-center"></i>
            <span>Periode Kabinet</span>
        </a>
        <a href="{{ route('admin.positions.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/positions*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-id-badge w-4 text-center"></i>
            <span>Jabatan</span>
        </a>
        <a href="{{ route('admin.divisions.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/divisions*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-sitemap w-4 text-center"></i>
            <span>Divisi</span>
        </a>
        <a href="{{ route('admin.members.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/members*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-users w-4 text-center"></i>
            <span>Anggota Himpunan</span>
        </a>

        <!-- Program & Content -->
        <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Program & Artikel</div>
        <a href="{{ route('admin.work-programs.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/work-programs*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-tasks w-4 text-center"></i>
            <span>Program Kerja</span>
        </a>
        <a href="{{ route('admin.activity-reports.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/activity-reports*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-newspaper w-4 text-center"></i>
            <span>Artikel & Berita</span>
        </a>
        <a href="{{ route('admin.about-pages.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/about-pages*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-file-alt w-4 text-center"></i>
            <span>Halaman Profil</span>
        </a>
        <a href="{{ route('admin.announcements.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/announcements*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-bullhorn w-4 text-center"></i>
            <span>Pengumuman</span>
        </a>

        <!-- Pemilu Cakahim -->
        <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Pemilu Cakahim</div>
        <a href="{{ route('admin.voting-schedules.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/voting-schedules*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-calendar-alt w-4 text-center"></i>
            <span>Jadwal Pemilu</span>
        </a>
        <a href="{{ route('admin.candidates.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/candidates*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-users-cog w-4 text-center"></i>
            <span>Calon Cakahim</span>
        </a>
        <a href="{{ route('admin.votes.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/votes*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-list-check w-4 text-center"></i>
            <span>Daftar Pemilih</span>
        </a>

        <!-- Store & Access -->
        <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Store & Hak Akses</div>
        <a href="{{ route('admin.merchandises.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/merchandises*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-box w-4 text-center"></i>
            <span>Daftar Produk</span>
        </a>
        <a href="{{ route('admin.merchandise-orders.index') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/merchandise-orders*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-shopping-cart w-4 text-center"></i>
            <span>Pesanan Merchandise</span>
        </a>
        <a href="{{ url('/admin/users') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ request()->is('admin/users*') ? 'bg-pink-600 text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <i class="fas fa-user-shield w-4 text-center"></i>
            <span>User Admin</span>
        </a>
    </div>

    <!-- Sidebar Footer / Profile -->
    <div class="p-4 border-t border-white/10 bg-black/20 rounded-b-2xl flex items-center justify-between">
        <div class="flex items-center gap-3 min-w-0">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e11d48&color=fff&bold=true"
                class="w-8 h-8 rounded-xl object-cover shrink-0">
            <div class="min-w-0 flex-1">
                <p class="text-xs font-bold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                <p class="text-[10px] font-semibold text-slate-400 uppercase truncate leading-tight">{{ Auth::user()->role }}</p>
            </div>
        </div>
        <button onclick="confirmLogout()" class="text-slate-400 hover:text-rose-400 transition-colors p-1.5 rounded-lg hover:bg-white/10" title="Logout">
            <i class="fas fa-sign-out-alt text-sm"></i>
        </button>
    </div>
</aside>

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
