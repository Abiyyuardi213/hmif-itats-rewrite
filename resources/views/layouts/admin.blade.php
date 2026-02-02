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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50/50 min-h-screen font-sans antialiased text-slate-800">

    <!-- Floating Navbar -->
    <x-admin-navbar />

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        @yield('content')
    </main>

</body>

</html>
