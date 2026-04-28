@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-4 sm:space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
                <p class="text-slate-500 mt-1 text-sm sm:text-base">Selamat datang kembali, {{ Auth::user()->name }}</p>
            </div>
            <div>
                <span
                    class="inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    System Online
                </span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <!-- Card 1 - Users -->
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <h3 class="text-xs sm:text-sm font-medium text-slate-500">Admin Users</h3>
                    <div class="p-1.5 sm:p-2 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $stats['users'] }}</span>
                    <span class="text-xs text-slate-400 font-medium">users</span>
                </div>
            </div>

            <!-- Card 2 - Members -->
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <h3 class="text-xs sm:text-sm font-medium text-slate-500">Anggota Organisasi</h3>
                    <div class="p-1.5 sm:p-2 bg-purple-50 text-purple-600 rounded-lg">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $stats['members'] }}</span>
                    <span class="text-xs text-emerald-600 font-medium">{{ $stats['divisions'] }} divisi</span>
                </div>
            </div>

            <!-- Card 3 - Announcements -->
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <h3 class="text-xs sm:text-sm font-medium text-slate-500">Pengumuman</h3>
                    <div class="p-1.5 sm:p-2 bg-amber-50 text-amber-600 rounded-lg">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $stats['announcements'] }}</span>
                    <span class="text-xs text-emerald-600 font-medium">{{ $stats['publishedAnnouncements'] }}
                        published</span>
                </div>
            </div>

            <!-- Card 4 - Work Programs -->
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <h3 class="text-xs sm:text-sm font-medium text-slate-500">Program Kerja</h3>
                    <div class="p-1.5 sm:p-2 bg-pink-50 text-pink-600 rounded-lg">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $stats['workPrograms'] }}</span>
                    <span class="text-xs text-slate-400 font-medium">programs</span>
                </div>
            </div>
        </div>

        <!-- Secondary Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
            <!-- Merchandise Stats -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 sm:p-6 rounded-xl border border-blue-100 shadow-sm">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <h3 class="text-xs sm:text-sm font-semibold text-slate-700">Merchandise</h3>
                    <div class="p-1.5 sm:p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-1.5 sm:space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Total Produk</span>
                        <span class="text-sm font-bold text-slate-900">{{ $stats['merchandises'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Tersedia</span>
                        <span class="text-sm font-bold text-emerald-600">{{ $stats['availableMerchandises'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Total Stok</span>
                        <span class="text-sm font-bold text-blue-600">{{ $stats['totalStock'] }} unit</span>
                    </div>
                </div>
            </div>

            <!-- Orders Stats -->
            <div
                class="bg-gradient-to-br from-emerald-50 to-teal-50 p-4 sm:p-6 rounded-xl border border-emerald-100 shadow-sm">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <h3 class="text-xs sm:text-sm font-semibold text-slate-700">Pesanan</h3>
                    <div class="p-1.5 sm:p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-1.5 sm:space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Total Pesanan</span>
                        <span class="text-sm font-bold text-slate-900">{{ $stats['orders'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Pending</span>
                        <span class="text-sm font-bold text-amber-600">{{ $stats['pendingOrders'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Selesai</span>
                        <span class="text-sm font-bold text-emerald-600">{{ $stats['completedOrders'] }}</span>
                    </div>
                </div>
            </div>

            <!-- System Stats -->
            <div
                class="bg-gradient-to-br from-purple-50 to-pink-50 p-4 sm:p-6 rounded-xl border border-purple-100 shadow-sm">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <h3 class="text-xs sm:text-sm font-semibold text-slate-700">Sistem</h3>
                    <div class="p-1.5 sm:p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-1.5 sm:space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Jabatan</span>
                        <span class="text-sm font-bold text-slate-900">{{ $stats['positions'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Divisi</span>
                        <span class="text-sm font-bold text-purple-600">{{ $stats['divisions'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-600">Status</span>
                        <span class="text-xs font-bold text-emerald-600 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Online
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 text-sm sm:text-base">Aktivitas Terbaru</h3>
                <button class="text-xs sm:text-sm text-primary font-medium hover:underline">Lihat Semua</button>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentActivities as $activity)
                    <div
                        class="px-4 sm:px-6 py-3 sm:py-4 flex items-start sm:items-center gap-3 sm:gap-4 hover:bg-slate-50 transition-colors cursor-pointer">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full {{ $activity->icon_bg }} flex items-center justify-center {{ $activity->icon_color }} shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $activity->icon_svg !!}
                            </svg>
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-slate-900 truncate">{{ $activity->title }}</p>
                            <p class="text-[10px] sm:text-xs text-slate-500 mt-0.5">{{ $activity->subtitle }} •
                                {{ $activity->time->diffForHumans() }}</p>
                        </div>
                        <div class="shrink-0">
                            <span
                                class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded text-[9px] sm:text-[10px] font-bold 
                                @if($activity->status_color == 'green') bg-green-100 text-green-700 border-green-200 
                                @elseif($activity->status_color == 'amber') bg-amber-100 text-amber-700 border-amber-200 
                                @elseif($activity->status_color == 'blue') bg-blue-100 text-blue-700 border-blue-200 
                                @elseif($activity->status_color == 'indigo') bg-indigo-100 text-indigo-700 border-indigo-200 
                                @elseif($activity->status_color == 'purple') bg-purple-100 text-purple-700 border-purple-200 
                                @else bg-gray-100 text-gray-700 border-gray-200 @endif border uppercase">
                                {{ $activity->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center text-slate-500">
                        <i class="fas fa-history text-2xl mb-2 opacity-20"></i>
                        <p class="text-sm">Belum ada aktivitas terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-lg border border-slate-100 shadow-lg'
                }
            });
        </script>
    @endif
@endsection
