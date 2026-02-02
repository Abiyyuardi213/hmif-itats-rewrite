<nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-100">
    <div class="max-w-[1600px] mx-auto px-6 sm:px-10 lg:px-12">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('image/hima-infor.png') }}" alt="HMIF Logo" class="w-12 h-12 object-contain">
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-tight text-slate-900 tracking-tight">Himpunan
                            Mahasiswa</span>
                        <span class="text-sm font-medium text-slate-500">Teknik Informatika ITATS</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ url('/') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-slate-600' }}">
                    Beranda
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('/') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ url('/struktur-organisasi') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('struktur-organisasi*') ? 'text-primary' : 'text-slate-600' }}">
                    Struktur Organisasi
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('struktur-organisasi*') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ url('/program-kerja') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('program-kerja*') ? 'text-primary' : 'text-slate-600' }}">
                    Program Kerja
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('program-kerja*') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ url('/kegiatan') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('kegiatan*') ? 'text-primary' : 'text-slate-600' }}">
                    Kegiatan
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('kegiatan*') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ url('/pengumuman') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('pengumuman*') ? 'text-primary' : 'text-slate-600' }}">
                    Pengumuman & Berita
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('pengumuman*') ? 'text-primary' : 'text-slate-600' }}"></span>
                </a>
                <a href="{{ url('/merchandise') }}"
                    class="relative group text-sm font-semibold transition-colors hover:text-primary {{ request()->is('merchandise*') ? 'text-primary' : 'text-slate-600' }}">
                    Official Merchandise
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full {{ request()->is('merchandise*') ? 'w-full' : '' }}"></span>
                </a>
            </div>

            <!-- CTA Button -->
            <div class="hidden md:flex items-center">
                <a href="#"
                    class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold transition-all duration-200 rounded-lg text-white bg-primary hover:opacity-90 shadow-md shadow-primary/20">
                    Kontak HMIF
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-slate-600 hover:text-primary focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 shadow-xl">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="{{ url('/') }}"
                class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->is('/') ? 'text-primary bg-slate-50' : 'text-slate-600' }}">Beranda</a>
            <a href="{{ url('/struktur-organisasi') }}"
                class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->is('struktur-organisasi*') ? 'text-primary bg-slate-50' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">Struktur
                Organisasi</a>
            <a href="{{ url('/program-kerja') }}"
                class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->is('program-kerja*') ? 'text-primary bg-slate-50' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">Program
                Kerja</a>
            <a href="{{ url('/kegiatan') }}"
                class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->is('kegiatan*') ? 'text-primary bg-slate-50' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">Kegiatan</a>
            <a href="{{ url('/pengumuman') }}"
                class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->is('pengumuman*') ? 'text-primary bg-slate-50' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">Pengumuman
                & Berita</a>
            <a href="{{ url('/merchandise') }}"
                class="block px-3 py-2 rounded-md text-base font-semibold {{ request()->is('merchandise*') ? 'text-primary bg-slate-50' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">Official
                Merchandise</a>
            <div class="pt-4 mt-4 border-t border-slate-100">
                <a href="#"
                    class="block w-full text-center px-4 py-3 rounded-lg text-white bg-primary hover:opacity-90 font-bold shadow-lg shadow-primary/20">
                    Kontak HMIF
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    });
</script>
