@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
                <p class="text-slate-500 mt-1">Selamat datang kembali, {{ Auth::user()->name }}</p>
            </div>
            <div>
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    System Online
                </span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-slate-500">Total Pengguna</h3>
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-slate-900">1</span>
                    <span class="text-xs text-emerald-600 font-medium">+0% vs last month</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-slate-500">Artikel / Berita</h3>
                    <div class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-slate-900">12</span>
                    <span class="text-xs text-emerald-600 font-medium">+2 new</span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-slate-500">Divisi</h3>
                    <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-slate-900">4</span>
                    <span class="text-xs text-slate-400 font-medium md:hidden lg:inline">Active Divisions</span>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-slate-500">Program Kerja</h3>
                    <div class="p-2 bg-pink-50 text-pink-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-slate-900">12</span>
                    <span class="text-xs text-emerald-600 font-medium">1 Completed</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900">Aktivitas Terbaru</h3>
                <button class="text-sm text-primary font-medium hover:underline">Lihat Semua</button>
            </div>
            <div class="divide-y divide-slate-100">
                <!-- Item 1 -->
                <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50 transition-colors cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-medium text-slate-900">Postingan baru dibuat: "Open Recruitment 2026"</p>
                        <p class="text-xs text-slate-500">Oleh <span class="font-medium text-slate-700">Dimas Admin</span> •
                            2 jam yang lalu</p>
                    </div>
                    <div>
                        <span
                            class="px-2 py-1 rounded text-[10px] font-bold bg-green-100 text-green-700 border border-green-200 uppercase">Published</span>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-medium text-slate-900">Percobaan login gagal terdeteksi</p>
                        <p class="text-xs text-slate-500">IP: 192.168.1.10 • 5 jam yang lalu</p>
                    </div>
                    <div>
                        <span
                            class="px-2 py-1 rounded text-[10px] font-bold bg-gray-100 text-gray-700 border border-gray-200 uppercase">Security</span>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-medium text-slate-900">Data anggota diperbarui</p>
                        <p class="text-xs text-slate-500">Oleh <span class="font-medium text-slate-700">Dimas Admin</span>
                            • 1 hari yang lalu</p>
                    </div>
                    <div>
                        <span
                            class="px-2 py-1 rounded text-[10px] font-bold bg-blue-100 text-blue-700 border border-blue-200 uppercase">System</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
