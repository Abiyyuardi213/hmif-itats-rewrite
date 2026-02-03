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

<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans antialiased text-slate-800">
    <div class="w-full max-w-md px-4 py-8">
        <!-- Logo Section -->
        <div class="flex flex-col items-center mb-8">
            <div
                class="w-20 h-20 bg-white rounded-2xl shadow-sm flex items-center justify-center border border-slate-200 mb-4">
                <img src="{{ asset('image/hima-infor.png') }}" alt="HMIF Logo" class="w-14 h-14 object-contain">
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Portal Admin <span
                    class="text-primary">HMIF</span></h1>
            <p class="text-sm text-slate-500 mt-1">Himpunan Mahasiswa Informatika</p>
        </div>

        <!-- Login Card -->
        <div class="p-8 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col space-y-1.5 mb-6">
                <h2 class="text-xl font-bold text-slate-900">Sign In</h2>
                <p class="text-sm text-slate-500">Masukan kredensial Anda untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ url('/login-admin') }}" class="space-y-5">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Email
                        Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" placeholder="admin@hmif.itats.ac.id"
                            required autofocus
                            class="flex h-11 w-full rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm transition-all focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none"
                            value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label for="password"
                            class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs font-medium text-primary hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="flex h-11 w-full rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm transition-all focus:ring-2 focus:ring-slate-900/5 focus:border-slate-400 outline-none">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" id="login-btn"
                        class="w-full flex items-center justify-center gap-2 h-11 bg-slate-900 text-white rounded-lg text-sm font-medium shadow-sm hover:bg-slate-800 active:scale-[0.98] transition-all disabled:opacity-70 disabled:cursor-not-allowed">
                        <span id="btn-text">Masuk ke Dashboard</span>
                        <svg id="btn-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <svg id="btn-spinner" class="hidden w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Info -->
        <p class="text-center text-xs text-slate-400 font-medium mt-8">
            &copy; 2025 HMIF ITATS • Creative Media
        </p>
    </div>

    <script>
        const loginForm = document.querySelector('form');
        const loginBtn = document.getElementById('login-btn');
        const btnText = document.getElementById('btn-text');
        const btnIcon = document.getElementById('btn-icon');
        const btnSpinner = document.getElementById('btn-spinner');

        loginForm.addEventListener('submit', function(e) {
            // Disable button
            loginBtn.disabled = true;

            // Change text
            btnText.textContent = 'Memproses...';

            // Hide icon, show spinner
            btnIcon.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
        });
    </script>
