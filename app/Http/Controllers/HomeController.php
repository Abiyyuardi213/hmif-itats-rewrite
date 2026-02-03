<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\WorkProgram;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Kegiatan Terdekat (Upcoming Activities)
        // Logic: Status 'mendatang' or 'berjalan', ordered by start_date ASC, take 1
        $upcomingActivity = WorkProgram::whereIn('status', ['mendatang', 'berjalan'])
            ->whereDate('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->first();

        // If no upcoming, take the latest completed/active one just to show something (optional, but requested 'data real')
        // User asked for 'kegiatan terdekat', so if none, maybe show nothing or generic message.
        // Let's stick to true upcoming/ongoing.


        // 2. Pengumuman (Announcements)
        // Logic: Published, latest, take 1
        $latestAnnouncement = Announcement::where('is_published', true)
            ->latest('published_at')
            ->first();

        // 3. Stats for "Sekilas Angka" (Optional improvement)
        $stats = [
            'programs' => WorkProgram::count(),
            'divisions' => \App\Models\Division::count(),
            'members' => \App\Models\OrgMember::count(),
        ];

        return view('welcome', compact('upcomingActivity', 'latestAnnouncement', 'stats'));
    }
}
