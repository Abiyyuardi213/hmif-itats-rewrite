<?php

namespace App\Http\Controllers;

use App\Models\WorkProgram;
use Illuminate\Http\Request;

class WorkProgramController extends Controller
{
    public function index()
    {
        $programs = WorkProgram::with(['division', 'head.position', 'teams.member.position', 'images'])
            ->orderBy('start_date', 'desc')
            ->get();

        return view('program-kerja', compact('programs'));
    }
}
