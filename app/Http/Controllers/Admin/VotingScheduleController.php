<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VotingSchedule;
use Illuminate\Http\Request;

class VotingScheduleController extends Controller
{
    public function index()
    {
        $schedules = VotingSchedule::withCount(['candidates', 'votes'])->latest()->get();
        return view('admin.voting.schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        VotingSchedule::create($validated);

        return redirect()->route('admin.voting-schedules.index')->with('success', 'Jadwal / Sesi Pemilihan Cakahim berhasil dibuat');
    }

    public function update(Request $request, VotingSchedule $votingSchedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : false;

        $votingSchedule->update($validated);

        return redirect()->route('admin.voting-schedules.index')->with('success', 'Jadwal Pemilihan berhasil diperbarui');
    }

    public function destroy(VotingSchedule $votingSchedule)
    {
        $votingSchedule->delete();
        return redirect()->route('admin.voting-schedules.index')->with('success', 'Jadwal Pemilihan berhasil dihapus');
    }
}
