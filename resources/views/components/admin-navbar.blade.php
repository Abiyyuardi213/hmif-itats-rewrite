<nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-100">
    <div class="max-w-[1600px] mx-auto px-3 sm:px-6 lg:px-12">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-2 sm:gap-3">
                    <img src="{{ asset('image/hima-infor.png') }}" alt="HMIF Logo"
                        class="w-10 h-10 sm:w-12 sm:h-12 object-contain">
                    <div class="hidden xs:flex flex-col">
                        <span class="font-bold text-base sm:text-lg leading-tight text-slate-900 tracking-tight">Admin
                            System</span>
                        <span class="text-[10px] sm:text-xs font-medium text-slate-500 uppercase tracking-widest">HMIF
                            ITATS</span>
                    </div>
                </a>
            </div>

            <!-- Middle: Nav Links -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ url('/admin/dashboard') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/dashboard') ? 'text-primary' : 'text-slate-600' }}">
                    Dashboard
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/dashboard') ? 'w-full' : '' }}"></span>
                </a>

                <div class="h-4 w-px bg-slate-200"></div>

                <a href="{{ route('admin.positions.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/positions*') ? 'text-primary' : 'text-slate-600' }}">
                    Jabatan
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/positions*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.divisions.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/divisions*') ? 'text-primary' : 'text-slate-600' }}">
                    Divisi
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/divisions*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.members.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/members*') ? 'text-primary' : 'text-slate-600' }}">
                    Anggota
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/members*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.work-programs.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/work-programs*') ? 'text-primary' : 'text-slate-600' }}">
                    Proker
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/work-programs*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.activity-reports.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/activity-reports*') ? 'text-primary' : 'text-slate-600' }}">
                    Artikel
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/activity-reports*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.about-pages.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/about-pages*') ? 'text-primary' : 'text-slate-600' }}">
                    Halaman
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/about-pages*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.announcements.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/announcements*') ? 'text-primary' : 'text-slate-600' }}">
                    Pengumuman
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/announcements*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.merchandises.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/merchandises*') ? 'text-primary' : 'text-slate-600' }}">
                    Merchandise
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/merchandises*') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('admin.merchandise-orders.index') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/merchandise-orders*') ? 'text-primary' : 'text-slate-600' }}">
                    Pesanan
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/merchandise-orders*') ? 'w-full' : '' }}"></span>
                </a>

                <div class="h-4 w-px bg-slate-200"></div>

                <a href="{{ url('/admin/users') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('admin/users*') ? 'text-primary' : 'text-slate-600' }}">
                    Akses Admin
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('admin/users*') ? 'w-full' : '' }}"></span>
                </a>
            </div>

            <!-- Right: Profile & Action -->
            <div class="flex items-center gap-2 sm:gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</span>
                    <span
                        class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">{{ Auth::user()->role }}</span>
                </div>

                <div class="relative group">
                    <button
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 p-0.5 border border-slate-200 focus:outline-none flex items-center justify-center overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=f8fafc&color=0f172a&bold=true"
                            class="w-full h-full object-cover">
                    </button>
                    <!-- Dropdown -->
                    <div
                        class="absolute top-full right-0 pt-3 w-56 hidden group-hover:block transition-all animate-in fade-in slide-in-from-top-2">
                        <div class="bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden">
                            <div class="px-4 py-3 bg-slate-50/50 border-b border-slate-100">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Signed in as
                                </p>
                                <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="p-1">
                                <a href="{{ url('/') }}"
                                    class="flex items-center gap-2 px-3 py-2 text-sm text-slate-600 rounded-lg hover:bg-slate-50">
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                    Lihat Website
                                </a>
                                <button type="button" onclick="confirmLogout()"
                                    class="w-full text-left flex items-center gap-2 px-3 py-2 text-sm text-rose-600 rounded-lg hover:bg-rose-50 font-bold">
                                    <i class="fas fa-sign-out-alt text-xs"></i>
                                    Logout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-6 w-px bg-slate-200 mx-2 hidden lg:block"></div>

                <button onclick="confirmLogout()"
                    class="hidden lg:flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                    <i class="fas fa-power-off"></i>
                    <span class="hidden xl:inline">Keluar</span>
                </button>

                <!-- Mobile Trigger -->
                <button id="admin-mobile-button" class="lg:hidden text-slate-600 p-2">
                    <i class="fas fa-bars text-lg sm:text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="admin-mobile-menu" class="hidden lg:hidden bg-white border-t border-slate-100 shadow-2xl">
        <div class="px-3 py-3 sm:p-4 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
            <a href="{{ url('/admin/dashboard') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/dashboard') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Dashboard</a>
            <a href="{{ route('admin.positions.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/positions*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Jabatan</a>
            <a href="{{ route('admin.divisions.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/divisions*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Divisi</a>
            <a href="{{ route('admin.members.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/members*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Anggota</a>
            <a href="{{ route('admin.work-programs.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/work-programs*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Proker</a>
            <a href="{{ route('admin.activity-reports.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/activity-reports*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Artikel</a>
            <a href="{{ route('admin.about-pages.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/about-pages*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Halaman</a>
            <a href="{{ route('admin.announcements.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/announcements*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Pengumuman</a>
            <a href="{{ route('admin.merchandises.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/merchandises*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Merchandise</a>
            <a href="{{ route('admin.merchandise-orders.index') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/merchandise-orders*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Pesanan</a>
            <a href="{{ url('/admin/users') }}"
                class="block px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl text-sm font-bold {{ request()->is('admin/users*') ? 'bg-primary/5 text-primary' : 'text-slate-600' }}">Akses
                Admin</a>
            <div class="pt-3 sm:pt-4 mt-3 sm:mt-4 border-t border-slate-100">
                <button onclick="confirmLogout()"
                    class="w-full py-2.5 sm:py-3 bg-rose-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-rose-600/20">LOGOUT</button>
            </div>
        </div>
    </div>
</nav>

<form id="logout-form" action="{{ url('/logout-admin') }}" method="POST" class="hidden">
    @csrf
</form>

<script>
    document.getElementById('admin-mobile-button').addEventListener('click', function() {
        const menu = document.getElementById('admin-mobile-menu');
        menu.classList.toggle('hidden');
    });

    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: "Apakah Anda yakin ingin mengakhiri sesi admin?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0f172a',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Logout Sekarang',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'px-6 py-3 rounded-xl font-bold text-sm',
                cancelButton: 'px-6 py-3 rounded-xl font-bold text-sm text-slate-600'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
