<div
    class="fixed top-6 left-1/2 -translate-x-1/2 z-50 w-full max-w-5xl px-4 animate-in fade-in slide-in-from-top-4 duration-500">
    <nav
        class="flex items-center justify-between px-4 py-3 bg-white rounded-2xl shadow-xl ring-1 ring-slate-200/60 mx-auto">

        <!-- Left Section: Logo & Nav Items -->
        <div class="flex items-center gap-6 pl-2">
            <!-- Logo Box -->
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center transition-opacity hover:opacity-80">
                <img src="{{ asset('image/hima-infor.png') }}" alt="HMIF Logo" class="w-12 h-12 object-contain">
            </a>

            <!-- Nav Links -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ url('/admin/dashboard') }}"
                    class="px-3 py-2 text-sm font-medium {{ request()->is('admin/dashboard') ? 'text-slate-900 bg-slate-50' : 'text-slate-500' }} rounded-lg hover:bg-slate-50 transition-colors">
                    Dashboard
                </a>

                <a href="{{ url('/admin/roles') }}"
                    class="px-3 py-2 text-sm font-medium {{ request()->is('admin/roles') ? 'text-slate-900 bg-slate-50' : 'text-slate-500' }} rounded-lg hover:bg-slate-50 transition-colors">
                    Role
                </a>

                <a href="{{ url('/admin/users') }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm font-medium {{ request()->is('admin/users') ? 'text-slate-900 bg-slate-50' : 'text-slate-500' }} rounded-lg hover:text-slate-900 hover:bg-slate-50 transition-colors group">
                    Pengguna
                </a>

                <a href="#"
                    class="px-3 py-2 text-sm font-medium text-slate-500 rounded-lg hover:text-slate-900 hover:bg-slate-50 transition-colors">
                    Konten
                </a>

                <a href="{{ route('admin.positions.index') }}"
                    class="px-3 py-2 text-sm font-medium {{ request()->is('admin/positions*') ? 'text-slate-900 bg-slate-50' : 'text-slate-500' }} rounded-lg hover:text-slate-900 hover:bg-slate-50 transition-colors">
                    Jabatan
                </a>

                <a href="{{ route('admin.divisions.index') }}"
                    class="px-3 py-2 text-sm font-medium {{ request()->is('admin/divisions*') ? 'text-slate-900 bg-slate-50' : 'text-slate-500' }} rounded-lg hover:text-slate-900 hover:bg-slate-50 transition-colors">
                    Divisi
                </a>

                <a href="{{ route('admin.members.index') }}"
                    class="px-3 py-2 text-sm font-medium {{ request()->is('admin/members*') ? 'text-slate-900 bg-slate-50' : 'text-slate-500' }} rounded-lg hover:text-slate-900 hover:bg-slate-50 transition-colors">
                    Anggota
                </a>

                <!-- Dropdown Trigger -->
                <div class="relative group">
                    <button
                        class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-slate-500 rounded-lg hover:text-slate-900 hover:bg-slate-50 transition-colors">
                        Pengaturan
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute top-full left-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden hidden group-hover:block animate-in fade-in slide-in-from-top-1">
                        <div class="p-1">
                            <a href="#"
                                class="block px-3 py-2 text-sm text-slate-600 rounded-lg hover:bg-slate-50 hover:text-slate-900">
                                Global Settings
                            </a>
                            <a href="{{ url('/admin/roles') }}"
                                class="block px-3 py-2 text-sm text-slate-600 rounded-lg hover:bg-slate-50 hover:text-slate-900">
                                Role & Permissions
                            </a>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-slate-600 rounded-lg hover:bg-slate-50 hover:text-slate-900">
                                Logs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section: Search, Profile, Action -->
        <div class="flex items-center gap-3 pr-1">

            <!-- Search Icon -->
            <button
                class="flex items-center justify-center w-10 h-10 text-slate-500 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>

            <div class="w-px h-8 bg-slate-100"></div>

            <!-- Profile Avatar -->
            <div class="relative group">
                <button
                    class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 p-0.5 focus:outline-none">
                    <div class="w-full h-full rounded-full bg-white flex items-center justify-center overflow-hidden">
                        <!-- Fallback Text Avatar -->
                        <span class="text-xs font-bold text-rose-500">AD</span>
                    </div>
                </button>
                <!-- Profile Dropdown -->
                <div
                    class="absolute top-full right-0 mt-4 w-56 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden hidden group-hover:block animate-in fade-in slide-in-from-top-1">
                    <div class="px-4 py-3 bg-slate-50 border-b border-slate-100">
                        <p class="text-sm font-bold text-slate-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="p-1">
                        <button type="button" onclick="confirmLogout()"
                            class="w-full text-left px-3 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Sign Out
                        </button>
                    </div>
                </div>
            </div>

            <!-- Action Button (Black) -->
            <button type="button" onclick="confirmLogout()"
                class="hidden md:flex items-center gap-2 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-slate-900/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Logout
            </button>

            <!-- Hidden Logout Form -->
            <form id="logout-form" action="{{ url('/logout-admin') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>
</div>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari sesi admin ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0f172a', // slate-900
            cancelButtonColor: '#f1f5f9', // slate-100
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'px-5 py-2.5 rounded-xl font-bold text-sm h-auto',
                cancelButton: 'px-5 py-2.5 rounded-xl font-bold text-sm h-auto text-slate-600'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>
