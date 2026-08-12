<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_published', true)
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(10);

        return view('pengumuman.index', compact('announcements'));
    }

    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $recentAnnouncements = Announcement::where('is_published', true)
            ->where('id', '!=', $announcement->id)
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->take(5)
            ->get();

        return view('pengumuman.show', compact('announcement', 'recentAnnouncements'));
    }
}
