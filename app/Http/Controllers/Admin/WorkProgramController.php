<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkProgram;
use App\Models\Division;
use App\Models\OrgMember;
use Illuminate\Http\Request;

class WorkProgramController extends Controller
{
    public function index()
    {
        $programs = WorkProgram::with(['division', 'head'])->orderBy('start_date', 'desc')->get();
        $divisions = Division::orderBy('order')->get();
        $members = OrgMember::orderBy('name')->get();
        return view('admin.work-programs.index', compact('programs', 'divisions', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'description' => 'nullable|string',
            'status' => 'required|in:selesai,berjalan,mendatang',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'head_id' => 'nullable|exists:org_members,id',
            'participants_count' => 'nullable|integer|min:0',
            'budget' => 'nullable|string|max:255',
            'team_count' => 'nullable|integer|min:0',
        ]);

        WorkProgram::create($validated);
        return redirect()->route('admin.work-programs.index')->with('success', 'Program kerja berhasil ditambahkan');
    }

    public function update(Request $request, WorkProgram $workProgram)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'description' => 'nullable|string',
            'status' => 'required|in:selesai,berjalan,mendatang',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'head_id' => 'nullable|exists:org_members,id',
            'participants_count' => 'nullable|integer|min:0',
            'budget' => 'nullable|string|max:255',
            'team_count' => 'nullable|integer|min:0',
        ]);

        $workProgram->update($validated);
        return redirect()->route('admin.work-programs.index')->with('success', 'Program kerja berhasil diperbarui');
    }

    public function destroy(WorkProgram $workProgram)
    {
        $workProgram->delete();
        return redirect()->route('admin.work-programs.index')->with('success', 'Program kerja berhasil dihapus');
    }
}
