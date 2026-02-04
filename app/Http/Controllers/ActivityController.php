<?php

namespace App\Http\Controllers;

use App\Models\WorkProgram;
use App\Models\ActivityReport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index()
    {
        // Calculate Stats from WorkPrograms (General Org Stats)
        $allPrograms = WorkProgram::get();
        $stats = [
            'completedPrograms' => $allPrograms->where('status', 'selesai')->count(),
            'totalParticipants' => $allPrograms->sum('participants_count'),
            'partners' => $allPrograms->whereNotNull('location')->unique('location')->count(),
            'activeMonths' => $allPrograms->whereNotNull('start_date')
                ->groupBy(function ($val) {
                    return Carbon::parse($val->start_date)->format('Y-m');
                })->count(),
        ];

        // Fetch Published Activity Reports
        $reports = ActivityReport::with(['workProgram.division', 'workProgram.images'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        // Map to view structure matching resources/views/kegiatan.blade.php
        $activities = $reports->map(function ($report) {
            $wp = $report->workProgram;
            $statusMap = [
                'selesai' => 'completed',
                'berjalan' => 'ongoing',
                'mendatang' => 'upcoming',
            ];

            return [
                'id' => $report->id,
                'title' => $report->title,
                'slug' => $report->slug,
                'category' => $wp->category ?? ($wp->division ? strtoupper($wp->division->name) : 'UMUM'),
                'date' => $report->published_at ?? $report->created_at,
                'participants_count' => $wp->participants_count,
                // Use excerpt or strip tags from content
                'description' => $report->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($report->content), 150),
                'status' => $statusMap[$wp->status] ?? $wp->status,
                'image' => $report->image ? asset('storage/' . $report->image) : ($wp->images->isNotEmpty() ? asset('storage/' . $wp->images->first()->image_path) : null),
            ];
        });

        return view('kegiatan', compact('activities', 'stats'));
    }

    public function show($slug)
    {
        $report = ActivityReport::with(['workProgram.division', 'workProgram.head', 'workProgram.teams.member.position', 'workProgram.images'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('kegiatan.show', compact('report'));
    }
}
