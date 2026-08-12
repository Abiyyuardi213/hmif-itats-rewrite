<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\VotingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        $selectedScheduleId = $request->get('schedule_id');
        $schedules = VotingSchedule::latest()->get();
        $activeSchedule = VotingSchedule::where('is_active', true)->first();

        if (!$selectedScheduleId) {
            $selectedScheduleId = $activeSchedule?->id ?? $schedules->first()?->id;
        }

        $candidates = collect();
        if ($selectedScheduleId) {
            $candidates = Candidate::where('voting_schedule_id', $selectedScheduleId)
                ->with(['orgMember.position', 'orgMember.division'])
                ->withCount('votes')
                ->orderBy('candidate_number')
                ->get();
        }

        // Active members only for candidate selection
        $activeMembers = \App\Models\OrgMember::where('status', 'aktif')
            ->with(['position', 'division'])
            ->orderBy('name')
            ->get();

        return view('admin.voting.candidates.index', compact('candidates', 'schedules', 'selectedScheduleId', 'activeSchedule', 'activeMembers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'voting_schedule_id' => 'required|exists:voting_schedules,id',
            'org_member_id' => 'required|exists:org_members,id',
            'candidate_number' => 'required|integer|min:1',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $member = \App\Models\OrgMember::findOrFail($validated['org_member_id']);
        $validated['name'] = $member->name;
        $validated['npm'] = $member->npm;
        $validated['photo'] = $member->image;

        Candidate::create($validated);

        return redirect()->route('admin.candidates.index', ['schedule_id' => $validated['voting_schedule_id']])
            ->with('success', 'Calon Cakahim berhasil ditambahkan dari Anggota Aktif');
    }

    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'voting_schedule_id' => 'required|exists:voting_schedules,id',
            'org_member_id' => 'required|exists:org_members,id',
            'candidate_number' => 'required|integer|min:1',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $member = \App\Models\OrgMember::findOrFail($validated['org_member_id']);
        $validated['name'] = $member->name;
        $validated['npm'] = $member->npm;
        $validated['photo'] = $member->image;

        $candidate->update($validated);

        return redirect()->back()->with('success', 'Data Cakahim berhasil diperbarui');
    }

    public function destroy(Candidate $candidate)
    {
        if ($candidate->photo) {
            Storage::disk('public')->delete($candidate->photo);
        }
        $candidate->delete();
        return redirect()->back()->with('success', 'Calon Cakahim berhasil dihapus');
    }
}
