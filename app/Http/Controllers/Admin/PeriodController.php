<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\OrgMember;
use App\Models\Position;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::withCount('members')->latest()->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'academic_year' => 'required|string|max:50',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : false;

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('periods', 'public');
        }

        if ($validated['is_active']) {
            Period::where('is_active', true)->update(['is_active' => false]);
        }

        Period::create($validated);

        return redirect()->route('admin.periods.index')->with('success', 'Periode / Kabinet berhasil ditambahkan');
    }

    public function update(Request $request, Period $period)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'academic_year' => 'required|string|max:50',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : false;

        if ($request->hasFile('logo')) {
            if ($period->logo) {
                Storage::disk('public')->delete($period->logo);
            }
            $validated['logo'] = $request->file('logo')->store('periods', 'public');
        }

        if ($validated['is_active'] && !$period->is_active) {
            Period::where('is_active', true)->update(['is_active' => false]);
        }

        $period->update($validated);

        return redirect()->route('admin.periods.index')->with('success', 'Periode / Kabinet berhasil diperbarui');
    }

    public function setActive(Period $period)
    {
        Period::where('is_active', true)->update(['is_active' => false]);
        $period->update(['is_active' => true]);

        return redirect()->back()->with('success', 'Kabinet ' . $period->name . ' (' . $period->academic_year . ') berhasil diaktifkan');
    }

    public function manageMembers(Period $period)
    {
        $members = OrgMember::where('period_id', $period->id)
            ->with(['position', 'division'])
            ->orderBy('order')
            ->get();

        $totalInti = $members->filter(fn($m) => $m->position && $m->position->type === 'inti')->count();
        $totalStaff = $members->filter(fn($m) => $m->position && $m->position->type !== 'inti')->count();

        $positions = Position::orderBy('order')->get();
        $divisions = Division::orderBy('order')->get();

        return view('admin.periods.manage_members', compact('period', 'members', 'totalInti', 'totalStaff', 'positions', 'divisions'));
    }

    public function destroy(Period $period)
    {
        if ($period->logo) {
            Storage::disk('public')->delete($period->logo);
        }
        $period->delete();

        // If active period deleted, set latest as active
        if ($period->is_active) {
            $latest = Period::latest()->first();
            if ($latest) {
                $latest->update(['is_active' => true]);
            }
        }

        return redirect()->route('admin.periods.index')->with('success', 'Periode berhasil dihapus');
    }
}
