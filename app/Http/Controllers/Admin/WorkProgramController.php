<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkProgram;
use App\Models\Division;
use App\Models\OrgMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkProgramController extends Controller
{
    public function index()
    {
        $programs = WorkProgram::with(['division', 'head', 'teams', 'images'])->orderBy('start_date', 'desc')->get();
        $divisions = Division::orderBy('order')->get();
        $members = OrgMember::orderBy('name')->get();
        return view('admin.work-programs.index', compact('programs', 'divisions', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'team_members' => 'nullable|array',
            'team_members.*' => 'exists:org_members,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (WorkProgram::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        $program = WorkProgram::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('work_programs', 'public');
                $program->images()->create(['image_path' => $path]);
            }
        }

        if ($request->has('team_members')) {
            foreach ($request->team_members as $memberId) {
                $program->teams()->create(['member_id' => $memberId]);
            }
        }

        return redirect()->route('admin.work-programs.index')->with('success', 'Program kerja berhasil ditambahkan');
    }

    public function update(Request $request, WorkProgram $workProgram)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'team_members' => 'nullable|array',
            'team_members.*' => 'exists:org_members,id',
        ]);

        if ($workProgram->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
            // Ensure unique slug
            $originalSlug = $validated['slug'];
            $count = 1;
            while (WorkProgram::where('slug', $validated['slug'])->where('id', '!=', $workProgram->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $workProgram->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('work_programs', 'public');
                $workProgram->images()->create(['image_path' => $path]);
            }
        }

        if ($request->has('team_members')) {
            // Simple sync: delete all and recreate
            $workProgram->teams()->delete();
            foreach ($request->team_members as $memberId) {
                $workProgram->teams()->create(['member_id' => $memberId]);
            }
        }

        return redirect()->route('admin.work-programs.index')->with('success', 'Program kerja berhasil diperbarui');
    }

    public function destroy(WorkProgram $workProgram)
    {
        $workProgram->delete();
        return redirect()->route('admin.work-programs.index')->with('success', 'Program kerja berhasil dihapus');
    }
}
