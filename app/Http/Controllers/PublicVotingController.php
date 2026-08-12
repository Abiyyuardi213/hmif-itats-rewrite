<?php

namespace App\Http\Controllers;

use App\Models\VotingSchedule;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicVotingController extends Controller
{
    public function index(Request $request)
    {
        $activeSchedule = VotingSchedule::where('is_active', true)
            ->with(['candidates' => function($q) {
                $q->withCount('votes')->orderBy('candidate_number');
            }])
            ->latest()
            ->first();

        $totalVotes = 0;
        if ($activeSchedule) {
            $totalVotes = $activeSchedule->votes()->count();
        }

        return view('voting.index', compact('activeSchedule', 'totalVotes'));
    }

    public function storeVote(Request $request)
    {
        $validated = $request->validate([
            'voting_schedule_id' => 'required|exists:voting_schedules,id',
            'candidate_id' => 'required|exists:candidates,id',
            'voter_type' => 'required|in:dosen,mahasiswa',
            'voter_name' => 'required|string|max:255',
            'voter_npm' => 'required_if:voter_type,mahasiswa|nullable|string|max:20',
            'voter_email' => 'nullable|email|max:255',
        ]);

        $schedule = VotingSchedule::findOrFail($validated['voting_schedule_id']);

        if (!$schedule->isOpen()) {
            return redirect()->back()->with('error', 'Maaf, sesi voting saat ini tidak aktif atau sudah ditutup.');
        }

        // If voter is Mahasiswa, check if NPM already voted in this schedule
        if ($validated['voter_type'] === 'mahasiswa') {
            $existingVote = Vote::where('voting_schedule_id', $schedule->id)
                ->where('voter_npm', $validated['voter_npm'])
                ->first();

            if ($existingVote) {
                return redirect()->back()->with('error', 'NPM bukan milik anda');
            }
        } else {
            // For Dosen, clear voter_npm to avoid null/empty collisions
            $validated['voter_npm'] = null;
        }

        $validated['ip_address'] = $request->ip();

        Vote::create($validated);

        return redirect()->back()->with('success', 'Terima kasih! Suara Anda telah berhasil direkam dalam Pemilu Cakahim.');
    }
}
