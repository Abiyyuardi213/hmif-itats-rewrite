<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Position;
use App\Models\Division;
use App\Models\OrgMember;
use App\Models\WorkProgram;
use App\Models\Announcement;
use App\Models\Merchandise;
use App\Models\MerchandiseOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'positions' => Position::count(),
            'divisions' => Division::count(),
            'members' => OrgMember::count(),
            'workPrograms' => WorkProgram::count(),
            'completedWorkPrograms' => WorkProgram::where('status', 'selesai')->count(),
            'ongoingWorkPrograms' => WorkProgram::where('status', 'berjalan')->count(),
            'upcomingWorkPrograms' => WorkProgram::where('status', 'mendatang')->count(),
            'announcements' => Announcement::count(),
            'publishedAnnouncements' => Announcement::where('is_published', true)->count(),
            'merchandises' => Merchandise::count(),
            'availableMerchandises' => Merchandise::where('is_available', true)->count(),
            'totalStock' => Merchandise::sum('stock'),
            'orders' => MerchandiseOrder::count(),
            'pendingOrders' => MerchandiseOrder::where('status', 'pending')->count(),
            'completedOrders' => MerchandiseOrder::where('status', 'completed')->count(),
        ];

        // Fetch activities from various sources
        $activities = collect();

        // 1. New Announcements
        Announcement::latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push((object)[
                'title' => 'Pengumuman: "' . $item->title . '"',
                'subtitle' => 'Oleh Admin',
                'time' => $item->created_at,
                'status' => $item->is_published ? 'Published' : 'Draft',
                'status_color' => $item->is_published ? 'green' : 'gray',
                'icon_bg' => 'bg-blue-100',
                'icon_color' => 'text-blue-600',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>'
            ]);
        });

        // 2. New Merchandise Orders
        MerchandiseOrder::with('merchandise')->latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push((object)[
                'title' => 'Pesanan: ' . ($item->merchandise->name ?? 'Merchandise'),
                'subtitle' => 'Oleh ' . $item->customer_name . ' • ' . $item->quantity . ' item',
                'time' => $item->created_at,
                'status' => strtoupper($item->status),
                'status_color' => in_array($item->status, ['completed', 'shipped']) ? 'green' : (in_array($item->status, ['pending', 'confirmed', 'processing']) ? 'amber' : 'red'),
                'icon_bg' => 'bg-emerald-100',
                'icon_color' => 'text-emerald-600',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>'
            ]);
        });

        // 3. New Work Programs
        WorkProgram::latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push((object)[
                'title' => 'Proker: ' . $item->name,
                'subtitle' => 'Status: ' . ucfirst($item->status),
                'time' => $item->created_at,
                'status' => 'PROGRAM',
                'status_color' => 'blue',
                'icon_bg' => 'bg-purple-100',
                'icon_color' => 'text-purple-600',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>'
            ]);
        });

        // 4. New Members
        OrgMember::with('division')->latest()->take(5)->get()->each(function ($item) use ($activities) {
            $activities->push((object)[
                'title' => 'Anggota baru: ' . $item->name,
                'subtitle' => 'Divisi: ' . ($item->division->name ?? 'Belum ada'),
                'time' => $item->created_at,
                'status' => 'MEMBER',
                'status_color' => 'indigo',
                'icon_bg' => 'bg-indigo-100',
                'icon_color' => 'text-indigo-600',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>'
            ]);
        });

        $recentActivities = $activities->sortByDesc('time')->take(8);

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}
