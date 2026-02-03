<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('pengumuman.index', compact('announcements'));
    }

    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pengumuman.show', compact('announcement'));
    }
}
