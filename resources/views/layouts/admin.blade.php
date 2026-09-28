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

<body class="bg-gray-50/50 min-h-screen font-sans antialiased text-slate-800">

    <!-- Floating Detached Sidebar -->
    <x-admin-navbar />

    <!-- Shifted Main Content (Clear of Floating Sidebar) -->
    <main class="lg:pl-80 px-4 sm:px-6 lg:pr-8 pt-6 pb-12 transition-all">
        <div class="max-w-[1600px] mx-auto space-y-6">
            @yield('content')
        </div>
    </main>

</body>

</html>
