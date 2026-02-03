<?php

namespace App\Http\Controllers;

use App\Models\WorkProgram;
use Illuminate\Http\Request;

class WorkProgramController extends Controller
{
    public function index()
    {
        $programsData = WorkProgram::with(['division', 'head.position', 'teams.member.position', 'images'])
            ->orderBy('start_date', 'desc')
            ->get();

        $programs = $programsData->map(function ($program) {
            $progress = 0;
            if ($program->status == 'selesai') {
                $progress = 100;
            } elseif ($program->status == 'berjalan') {
                if ($program->start_date && $program->end_date) {
                    $start = \Carbon\Carbon::parse($program->start_date);
                    $end = \Carbon\Carbon::parse($program->end_date);
                    $now = \Carbon\Carbon::now();

                    if ($end->gt($start) && $now->gt($start)) {
                        $totalDuration = $end->diffInMinutes($start);
                        $elapsed = $now->diffInMinutes($start);
                        if ($totalDuration > 0) {
                            $progress = min(100, round(($elapsed / $totalDuration) * 100));
                        }
                    }
                }
                if ($progress == 0) $progress = 50;
            }

            return [
                'id' => $program->id,
                'title' => $program->name,
                'department' => $program->division ? $program->division->name : 'Umum',
                'description' => \Illuminate\Support\Str::limit($program->description, 100),
                'detailedDescription' => $program->description,
                'status' => $program->status,
                'startDate' => $program->start_date,
                'endDate' => $program->end_date,
                'location' => $program->location ?? '-',
                'participants' => $program->participants_count ?? 0,
                'budget' => $program->budget ?? '-',
                'progress' => $progress,
                'leader' => $program->head ? $program->head->name : '-',
                'leaderAvatar' => $program->head && $program->head->image ? asset('storage/' . $program->head->image) : null,
                'team' => $program->teams->map(function ($team) {
                    return [
                        'name' => $team->member->name,
                        'role' => $team->role ?? ($team->member->position ? $team->member->position->name : 'Anggota'),
                        'avatar' => $team->member->image ? asset('storage/' . $team->member->image) : null,
                    ];
                }),
                'photos' => $program->images->map(function ($img) {
                    return asset('storage/' . $img->image_path);
                }),
            ];
        });

        return view('program-kerja', compact('programs'));
    }
}
