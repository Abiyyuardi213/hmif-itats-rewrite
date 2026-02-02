<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HMIF ITATS - Himpunan Mahasiswa Informatika')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('image/icon-hmif.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('image/icon-hmif.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800 bg-gray-50/50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <main class="flex-grow pt-16 pb-12">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

</body>

</html>
