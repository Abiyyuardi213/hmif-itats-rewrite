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
            $totalVotes = $activeSchedule->votes()->where('status', 'verified')->count();
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
            'voter_name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[a-zA-Z\s\.\,\'\-]+$/', // Only real names with letters, spaces, dots, commas, quotes
            ],
            'voter_npm' => [
                'required_if:voter_type,mahasiswa',
                'nullable',
                'string',
                'regex:/^\d{2}\.\d{4}\.\d{1}\.\d{5}$/', // Enforce exact ITATS NPM format: XX.YYYY.Z.12345 (e.g., 06.2023.1.07709 or 13.2023.1.00000)
            ],
            'voter_email' => 'required_if:voter_type,dosen|nullable|email|max:255',
        ], [
            'voter_name.min' => 'Nama lengkap pemilih minimal 3 karakter.',
            'voter_name.regex' => 'Nama pemilih hanya boleh mengandung huruf, spasi, serta tanda baca nama yang valid (bukan kata acak/anomali).',
            'voter_npm.regex' => 'Format NPM tidak valid. Contoh format NPM yang benar: 06.2023.1.07709 atau 13.2023.1.00000',
            'voter_email.required_if' => 'Email wajib diisi untuk pemilih dengan status Dosen.',
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

            // Rule 1: Enforce code 06 prefix (Teknik Informatika)
            if (!str_starts_with($npm, '06.')) {
                return redirect()->back()->with('error', 'Ancaman keamanan terdeteksi');
            }

            // Check if NPM already voted in this schedule
            $existingVote = Vote::where('voting_schedule_id', $schedule->id)
                ->where('voter_npm', $npm)
                ->first();

            if ($existingVote) {
                return redirect()->back()->with('error', 'NPM (' . $npm . ') sudah pernah digunakan untuk voting pada sesi ini.');
            }

            $validated['voter_npm'] = $npm;

            // Determine year from NPM (format: 06.YYYY.X.XXXXX)
            $npmParts = explode('.', $npm);
            $year = isset($npmParts[1]) ? (int)$npmParts[1] : 0;

            if ($year >= 2025) {
                // Rule 2: For 06.2025 and 06.2026, verify against excel data_mhs.xlsx
                $excelPath = public_path('excel/data_mhs.xlsx');
                $isFoundInExcel = false;

                if (file_exists($excelPath)) {
                    $zip = new \ZipArchive();
                    if ($zip->open($excelPath) === TRUE) {
                        $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
                        if ($sharedStringsXml && str_contains($sharedStringsXml, $npm)) {
                            $isFoundInExcel = true;
                        }
                        $zip->close();
                    }
                }

                if (!$isFoundInExcel) {
                    return redirect()->back()->with('error', 'Data NPM (' . $npm . ') tidak ditemukan di database mahasiswa aktif (data_mhs.xlsx). Hak suara ditolak.');
                }

                $validated['status'] = 'verified';
            } else {
                // Rule 3: For 2024 and older (e.g., 06.2024, 06.2023, 06.2022), set status to pending for admin verification
                $validated['status'] = 'pending';
            }
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
            $validated['status'] = 'verified';
        }

        $validated['ip_address'] = $ipAddress;

        Vote::create($validated);

        if (isset($validated['status']) && $validated['status'] === 'pending') {
            return redirect()->back()->with('success', 'Suara Anda telah terkirim! Karena NPM Anda angkatan ' . ($year ?? '') . ', status suara Anda berada dalam antrean [PENDING] untuk diverifikasi oleh Admin.');
        }

        return redirect()->back()->with('success', 'Terima kasih! Suara Anda telah berhasil direkam dalam Pemilu Cakahim.');
    }
}
