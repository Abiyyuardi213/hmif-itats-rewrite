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
                $q->orderBy('candidate_number');
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
        // 1. Honeypot check for bots (website_url should be empty)
        if ($request->filled('website_url')) {
            return redirect()->back()->with('error', 'Akses terdeteksi sebagai bot otomatis.');
        }

        $validated = $request->validate([
            'voting_schedule_id' => 'required|exists:voting_schedules,id',
            'candidate_id' => 'required|exists:candidates,id',
            'voter_type' => 'required|in:dosen,mahasiswa',
            'voter_name' => 'required|string|max:255',
            'voter_npm' => 'required_if:voter_type,mahasiswa|nullable|string|max:20',
            'voter_email' => 'required_if:voter_type,dosen|nullable|email|max:255',
        ]);

        // Sanitize string inputs to prevent Stored XSS Attacks
        $validated['voter_name'] = trim(strip_tags($validated['voter_name']));
        if (isset($validated['voter_npm'])) {
            $validated['voter_npm'] = trim(strip_tags($validated['voter_npm']));
        }
        if (isset($validated['voter_email'])) {
            $validated['voter_email'] = trim(strip_tags($validated['voter_email']));
        }

        $schedule = VotingSchedule::findOrFail($validated['voting_schedule_id']);

        if (!$schedule->isOpen()) {
            return redirect()->back()->with('error', 'Maaf, sesi voting saat ini tidak aktif atau sudah ditutup.');
        }

        $ipAddress = $request->ip();

        // 2. IP Address Rate limit per schedule (max 3 votes per IP per schedule)
        $ipVoteCount = Vote::where('voting_schedule_id', $schedule->id)
            ->where('ip_address', $ipAddress)
            ->count();

        if ($ipVoteCount >= 3) {
            return redirect()->back()->with('error', 'Batas maksimum voting dari perangkat/jaringan IP Anda telah tercapai.');
        }

        // 3. Validation per Voter Type
        if ($validated['voter_type'] === 'mahasiswa') {
            // Standardize NPM format
            $npm = trim($validated['voter_npm']);

            // Check if NPM already voted in this schedule
            $existingVote = Vote::where('voting_schedule_id', $schedule->id)
                ->where('voter_npm', $npm)
                ->first();

            if ($existingVote) {
                return redirect()->back()->with('error', 'NPM (' . $npm . ') sudah pernah digunakan untuk voting pada sesi ini.');
            }

            $validated['voter_npm'] = $npm;
        } else {
            // Dosen Validation: Require valid email & Check if email already voted in this schedule
            $email = strtolower(trim($validated['voter_email']));

            $existingVote = Vote::where('voting_schedule_id', $schedule->id)
                ->where('voter_email', $email)
                ->first();

            if ($existingVote) {
                return redirect()->back()->with('error', 'Email Dosen (' . $email . ') sudah pernah digunakan untuk voting pada sesi ini.');
            }

            $validated['voter_email'] = $email;
            $validated['voter_npm'] = null;
        }

        $validated['ip_address'] = $ipAddress;

        Vote::create($validated);

        return redirect()->back()->with('success', 'Terima kasih! Suara Anda telah berhasil direkam dalam Pemilu Cakahim.');
    }
}
