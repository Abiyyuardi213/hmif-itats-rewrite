<nav class="fixed w-full z-50 transition-all duration-300 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <!-- Logo Placeholder -->
                    <div
                        class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center overflow-hidden border border-slate-200">
                        <!-- Replace with actual logo img tag -->
                        <span class="text-xs font-bold text-slate-600">HMIF</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-base leading-tight text-slate-900">Himpunan Mahasiswa</span>
                        <span class="text-xs text-slate-500">Teknik Informatika ITATS</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}"
                    class="relative text-sm font-medium transition-colors hover:text-primary after:absolute after:-bottom-2 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-primary after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100 {{ request()->is('/') ? 'text-primary font-bold after:scale-x-100' : 'text-slate-600' }}">Beranda</a>
                <a href="{{ url('/struktur-organisasi') }}"
                    class="relative text-sm font-medium transition-colors hover:text-primary after:absolute after:-bottom-2 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-primary after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100 {{ request()->is('struktur-organisasi*') ? 'text-primary font-bold after:scale-x-100' : 'text-slate-600' }}">Struktur
                    Organisasi</a>
                <a href="{{ url('/divisi') }}"
                    class="relative text-sm font-medium transition-colors hover:text-primary after:absolute after:-bottom-2 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-primary after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100 {{ request()->is('divisi*') ? 'text-primary font-bold after:scale-x-100' : 'text-slate-600' }}">Divisi</a>
                <a href="{{ url('/program-kerja') }}"
                    class="relative text-sm font-medium transition-colors hover:text-primary after:absolute after:-bottom-2 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-primary after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100 {{ request()->is('program-kerja*') ? 'text-primary font-bold after:scale-x-100' : 'text-slate-600' }}">Program
                    Kerja</a>
                <a href="{{ url('/kegiatan') }}"
                    class="relative text-sm font-medium transition-colors hover:text-primary after:absolute after:-bottom-2 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-primary after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100 {{ request()->is('kegiatan*') ? 'text-primary font-bold after:scale-x-100' : 'text-slate-600' }}">Kegiatan</a>
                <a href="{{ url('/pengumuman') }}"
                    class="relative text-sm font-medium transition-colors hover:text-primary after:absolute after:-bottom-2 after:left-0 after:h-[2px] after:w-full after:origin-center after:scale-x-0 after:bg-primary after:transition-transform after:duration-300 after:ease-in-out hover:after:scale-x-100 {{ request()->is('pengumuman*') ? 'text-primary font-bold after:scale-x-100' : 'text-slate-600' }}">Pengumuman
                    &
                    Berita</a>
            </div>

            <!-- CTA Button -->
            <div class="hidden md:flex items-center">
                <a href="#"
                    class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold transition-all duration-200 rounded text-white bg-primary hover:bg-primary-hover shadow-md shadow-primary/20">
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
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 shadow-lg">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="{{ url('/') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-900 bg-slate-50">Beranda</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-primary hover:bg-slate-50">Struktur
                Organisasi</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-primary hover:bg-slate-50">Divisi</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-primary hover:bg-slate-50">Program
                Kerja</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-primary hover:bg-slate-50">Kegiatan</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-primary hover:bg-slate-50">Pengumuman
                & Berita</a>
            <div class="pt-4 mt-4 border-t border-slate-100">
                <a href="#"
                    class="block w-full text-center px-4 py-3 rounded text-white bg-primary hover:bg-primary-hover font-bold">
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
