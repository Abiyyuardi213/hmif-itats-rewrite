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
            'announcements' => Announcement::count(),
            'publishedAnnouncements' => Announcement::where('is_published', true)->count(),
            'merchandises' => Merchandise::count(),
            'availableMerchandises' => Merchandise::where('is_available', true)->count(),
            'totalStock' => Merchandise::sum('stock'),
            'orders' => MerchandiseOrder::count(),
            'pendingOrders' => MerchandiseOrder::where('status', 'pending')->count(),
            'completedOrders' => MerchandiseOrder::where('status', 'completed')->count(),
        ];

        // Recent activities (latest 5)
        $recentAnnouncements = Announcement::latest()->take(3)->get();
        $recentOrders = MerchandiseOrder::with('merchandise')->latest()->take(3)->get();

        return view('admin.dashboard', compact('stats', 'recentAnnouncements', 'recentOrders'));
    }
}
