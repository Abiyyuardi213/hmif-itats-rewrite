<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HMIF ITATS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans antialiased text-slate-800">

    <div class="w-full max-w-sm bg-white border border-slate-200 rounded-xl shadow-sm p-8">
        <div class="flex flex-col space-y-2 text-center mb-6">
            <h1 class="text-2xl font-semibold tracking-tight">Login Admin</h1>
            <p class="text-sm text-slate-500">
                Masukan email dan password untuk akses dashboard
            </p>
        </div>

        <form method="POST" action="{{ url('/login-admin') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <label for="email"
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
                <input type="email" id="email" name="email" placeholder="nama@contoh.com" required autofocus
                    class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-sm font-medium text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="password"
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Password</label>
                <input type="password" id="password" name="password" required
                    class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
            </div>

            <button type="submit"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-white hover:bg-primary-hover h-10 px-4 py-2 w-full mt-2">
                Sign In
            </button>
        </form>
    </div>

</body>

</html>
