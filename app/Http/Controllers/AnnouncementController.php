<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcementsData = Announcement::where('is_published', true)
            ->latest('published_at')
            ->get();

        $postsData = $announcementsData->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($item->content), 150),
                'date' => $item->published_at ? $item->published_at->format('Y-m-d') : $item->created_at->format('Y-m-d'),
                'category' => 'pengumuman', // Default category since table doesn't have it yet, or add migration
                'priority' => 'sedang', // Default priority
                'author_name' => 'Admin HMIF',
                'image' => $item->image ? asset('storage/' . $item->image) : null,
                'tags' => ['Pengumuman'],
                'is_active' => true,
            ];
        });

        return view('pengumuman.index', compact('postsData'));
    }

    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pengumuman.show', compact('announcement'));
    }
}
