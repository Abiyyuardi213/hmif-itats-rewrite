<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HMIF ITATS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('image/icon-hmif.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('image/icon-hmif.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body
    class="bg-slate-50/50 flex items-center justify-center min-h-screen font-sans antialiased text-slate-800 relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute top-0 left-0 w-full h-full -z-10">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-[120px]">
        </div>
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-secondary/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-sm px-4">
        <!-- Logo Section -->
        <div
            class="flex flex-col items-center mb-10 translate-y-4 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div
                class="w-20 h-20 bg-white rounded-2xl shadow-xl shadow-primary/10 flex items-center justify-center border border-slate-100 mb-6 group transition-transform hover:scale-105">
                <img src="{{ asset('image/hima-infor.png') }}" alt="HMIF Logo" class="w-14 h-14 object-contain">
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Portal Admin <span
                    class="text-primary">HMIF</span></h1>
            <p class="text-sm text-slate-400 font-medium mt-1">Himpunan Mahasiswa Informatika</p>
        </div>

        <!-- Login Card -->
        <div
            class="bg-white border border-slate-200 rounded-[2rem] shadow-2xl shadow-slate-200/50 p-8 md:p-10 animate-in fade-in zoom-in-95 duration-500 delay-200">
            <div class="flex flex-col space-y-1.5 mb-8">
                <h2 class="text-xl font-bold text-slate-900">Sign In</h2>
                <p class="text-sm text-slate-500 font-medium">Masukan kredensial Anda untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ url('/login-admin') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Email
                        Address</label>
                    <div class="relative group">
                        <input type="email" id="email" name="email" placeholder="admin@hmif.itats.ac.id"
                            required autofocus
                            class="flex h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2 text-sm transition-all focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none group-hover:border-slate-300"
                            value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-[11px] font-bold text-red-500 mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label for="password"
                            class="text-xs font-bold uppercase tracking-widest text-slate-400">Password</label>
                        <a href="#" class="text-[11px] font-bold text-primary hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="flex h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2 text-sm transition-all focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none group-hover:border-slate-300">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 h-12 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-xl shadow-slate-900/20 hover:bg-slate-800 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Masuk ke Dashboard
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Info -->
        <p
            class="text-center text-[11px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-10 animate-in fade-in slide-in-from-top-4 duration-700 delay-500">
            &copy; 2025 HMIF ITATS • Creative Media
        </p>
    </div>

</body>

</html>
