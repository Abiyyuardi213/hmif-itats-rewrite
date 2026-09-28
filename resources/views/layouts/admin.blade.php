<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - HMIF Admin</title>
    <link rel="shortcut icon" href="{{ asset('image/icon-hmif.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('image/icon-hmif.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
</head>

<body class="bg-gray-50/50 min-h-screen font-sans antialiased text-slate-800 flex flex-col">

    <!-- Floating Sidebar -->
    <x-admin-navbar />

    <!-- Main Outer Container with Sidebar Offset -->
    <div class="lg:pl-72 flex flex-col min-h-screen transition-all duration-300">
        
        <!-- Sticky Header (Seamless background with page content, border appears on scroll) -->
        <header id="admin-sticky-header" class="sticky top-0 z-30 w-full bg-gray-50/70 border-transparent backdrop-blur-md pt-4 pb-2 transition-all duration-300">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    
                    <!-- Left: Title Context -->
                    <div class="flex items-center gap-3">
                        <div class="flex flex-col">
                            <h2 class="text-sm font-bold text-slate-800 tracking-tight leading-none">
                                @yield('title', 'Dashboard')
                            </h2>
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mt-1">
                                HMIF ITATS Portal
                            </span>
                        </div>
                    </div>

                    <!-- Right: Actions & Profile -->
                    <div class="flex items-center gap-3">
                        <!-- System Online Badge -->
                        <span class="hidden md:inline-flex items-center px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 text-xs font-extrabold shadow-sm tracking-tight transition-all">
                            <span class="relative flex h-2 w-2 mr-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            System Online
                        </span>

                        <a href="{{ url('/') }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white/80 hover:bg-white text-slate-700 text-xs font-bold rounded-xl border border-slate-200/60 shadow-sm transition-all hover:text-slate-900">
                            <i class="fas fa-external-link-alt text-[10px]"></i>
                            <span>Lihat Website</span>
                        </a>

                        <button onclick="confirmLogout()"
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold rounded-xl shadow-md shadow-rose-500/20 transition-all active:scale-95">
                            <i class="fas fa-power-off text-xs"></i>
                            <span>Keluar</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-6 flex-grow w-full">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('admin-sticky-header');
            if (header) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 20) {
                        header.classList.remove('bg-gray-50/70', 'border-transparent');
                        header.classList.add('bg-gray-50/80', 'shadow-sm', 'border-b', 'border-slate-200/60');
                    } else {
                        header.classList.remove('bg-gray-50/80', 'shadow-sm', 'border-b', 'border-slate-200/60');
                        header.classList.add('bg-gray-50/70', 'border-transparent');
                    }
                });
            }
        });
    </script>
</body>

</html>
