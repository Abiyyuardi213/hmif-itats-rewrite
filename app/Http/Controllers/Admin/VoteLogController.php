<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\VotingSchedule;
use Illuminate\Http\Request;

class VoteLogController extends Controller
{
    public function index(Request $request)
    {
        $schedules = VotingSchedule::latest()->get();
        $selectedScheduleId = $request->get('schedule_id');
        $search = $request->get('search');
        $voterType = $request->get('voter_type');

        if (!$selectedScheduleId) {
            $activeSchedule = VotingSchedule::where('is_active', true)->first();
            $selectedScheduleId = $activeSchedule?->id ?? $schedules->first()?->id;
        }

        $query = Vote::with(['candidate', 'schedule']);

        if ($selectedScheduleId) {
            $query->where('voting_schedule_id', $selectedScheduleId);
        }

        if ($voterType) {
            $query->where('voter_type', $voterType);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('voter_name', 'like', "%{$search}%")
                  ->orWhere('voter_npm', 'like', "%{$search}%")
                  ->orWhere('voter_email', 'like', "%{$search}%");
            });
        }

        $votes = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total' => Vote::where('voting_schedule_id', $selectedScheduleId)->count(),
            'mahasiswa' => Vote::where('voting_schedule_id', $selectedScheduleId)->where('voter_type', 'mahasiswa')->count(),
            'dosen' => Vote::where('voting_schedule_id', $selectedScheduleId)->where('voter_type', 'dosen')->count(),
        ];

        return view('admin.voting.votes.index', compact('votes', 'schedules', 'selectedScheduleId', 'search', 'voterType', 'stats'));
    }

    public function destroy(Vote $vote)
    {
        $scheduleId = $vote->voting_schedule_id;
        $vote->delete();

        return redirect()->route('admin.votes.index', ['schedule_id' => $scheduleId])
            ->with('success', 'Data pemilih / riwayat vote berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:votes,id',
        ]);

        $scheduleId = $request->get('schedule_id');
        Vote::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.votes.index', ['schedule_id' => $scheduleId])
            ->with('success', count($request->ids) . ' data pemilih berhasil dihapus.');
    }
}
