<?php

namespace App\Http\Controllers;

use App\Models\WorkProgram;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index()
    {
        // Fetch all programs, ordered by date desc
        $programs = WorkProgram::with(['division', 'head', 'teams', 'images'])
            ->orderBy('start_date', 'desc')
            ->get();

        // Calculate Stats
        $stats = [
            'completedPrograms' => $programs->where('status', 'selesai')->count(),
            'totalParticipants' => $programs->sum('participants_count'),
            'partners' => $programs->whereNotNull('location')->unique('location')->count(), // Estimation
            'activeMonths' => $programs->whereNotNull('start_date')
                ->groupBy(function ($val) {
                    return Carbon::parse($val->start_date)->format('Y-m');
                })->count(),
        ];

        // Map to view structure
        $activities = $programs->map(function ($program) {
            $statusMap = [
                'selesai' => 'completed',
                'berjalan' => 'ongoing',
                'mendatang' => 'upcoming',
            ];

            return [
                'id' => $program->id,
                'title' => $program->name,
                'slug' => $program->slug ?? \Illuminate\Support\Str::slug($program->name), // Fallback
                'category' => $program->category ?? ($program->division ? strtoupper($program->division->name) : 'UMUM'),
                'date' => $program->start_date,
                'participants_count' => $program->participants_count,
                'description' => $program->description,
                'status' => $statusMap[$program->status] ?? $program->status,
                'image' => $program->images->isNotEmpty() ? asset('storage/' . $program->images->first()->image_path) : null,
            ];
        });

        // If blade expects 'activities' and 'stats'
        return view('kegiatan', compact('activities', 'stats'));
    }

    public function show($slug)
    {
        $program = WorkProgram::with(['division', 'head', 'teams.member.position', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Reuse the detail modal logic or create a separate page?
        // The accessible URL is /kegiatan/{slug}
        // I might need a 'kegiatan-detail' view OR pass it to kegiatan view to open modal?
        // The blade `kegiatan.blade.php` has a link: <a href="/kegiatan/{{ $activity['slug'] }}" class="block group">
        // So it expects a separate page.

        // I'll create a simple detail view or reuse program-kerja detail style. 
        // For now let's just dump the data or create a view.
        // User said: "tambahkan mulai dari backend hingga frontend"
        // So I should create a view `resources/views/kegiatan/show.blade.php`.

        return view('kegiatan.show', compact('program'));
    }
}
