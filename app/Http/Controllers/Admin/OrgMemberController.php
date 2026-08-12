<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrgMember;
use App\Models\Position;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrgMemberController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
        $activePeriod = \App\Models\Period::where('is_active', true)->first();

        // 1. Members in active period (10 per page)
        $activeMembers = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
        if ($activePeriod) {
            $activeMembers = OrgMember::where('period_id', $activePeriod->id)
                ->with(['position', 'division', 'period'])
                ->orderBy('order')
                ->latest()
                ->paginate(10, ['*'], 'page_active')
                ->withQueryString();
        }

        // 2. Members in inactive/past periods or no period (10 per page)
        $inactiveMembers = OrgMember::where(function($q) use ($activePeriod) {
                if ($activePeriod) {
                    $q->where('period_id', '!=', $activePeriod->id)->orWhereNull('period_id');
                }
            })
            ->with(['position', 'division', 'period'])
            ->latest()
            ->paginate(10, ['*'], 'page_inactive')
            ->withQueryString();

        $totalMembers = OrgMember::count();
        $totalActive = $activePeriod ? OrgMember::where('period_id', $activePeriod->id)->count() : 0;
        $totalAlumni = OrgMember::where(function($q) use ($activePeriod) {
            if ($activePeriod) {
                $q->where('period_id', '!=', $activePeriod->id)->orWhereNull('period_id');
            }
        })->count();

        $positions = Position::orderBy('order')->get();
        $divisions = Division::orderBy('order')->get();
        $periods = \App\Models\Period::latest()->get();

        return view('admin.members.index', compact(
            'type',
            'activeMembers',
            'inactiveMembers',
            'totalMembers',
            'totalActive',
            'totalAlumni',
            'positions',
            'divisions',
            'periods',
            'activePeriod'
        ));
    }

    public function create()
    {
        $positions = Position::orderBy('order')->get();
        $divisions = Division::orderBy('order')->get();
        $periods = \App\Models\Period::latest()->get();
        $activePeriod = \App\Models\Period::where('is_active', true)->first();
        return view('admin.members.create', compact('positions', 'divisions', 'periods', 'activePeriod'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period_id' => 'required|exists:periods,id',
            'name' => 'required|string|max:255',
            'npm' => 'nullable|string|max:20',
            'position_id' => 'required|exists:positions,id',
            'division_id' => 'nullable|exists:divisions,id',
            'status' => 'nullable|string|in:aktif,tidak aktif',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'nullable|integer',
        ]);

        $validated['status'] = $validated['status'] ?? 'aktif';
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('members', 'public');
        }

        OrgMember::create($validated);

        if ($request->wantsJson()) {
            session()->flash('success', 'Anggota berhasil ditambahkan');
            return response()->json(['message' => 'Success']);
        }

        return redirect()->route('admin.members.index', ['period_id' => $validated['period_id']])->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit(OrgMember $member)
    {
        $positions = Position::orderBy('order')->get();
        $divisions = Division::orderBy('order')->get();
        $periods = \App\Models\Period::latest()->get();
        return view('admin.members.edit', compact('member', 'positions', 'divisions', 'periods'));
    }

    public function update(Request $request, OrgMember $member)
    {
        $validated = $request->validate([
            'period_id' => 'required|exists:periods,id',
            'name' => 'required|string|max:255',
            'npm' => 'nullable|string|max:20',
            'position_id' => 'required|exists:positions,id',
            'division_id' => 'nullable|exists:divisions,id',
            'status' => 'nullable|string|in:aktif,tidak aktif',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $validated['image'] = $request->file('image')->store('members', 'public');
        }

        $member->update($validated);

        if ($request->wantsJson()) {
            session()->flash('success', 'Anggota berhasil diperbarui');
            return response()->json(['message' => 'Success']);
        }

        return redirect()->back()->with('success', 'Anggota berhasil diperbarui');
    }

    public function toggleStatus(OrgMember $member)
    {
        $newStatus = ($member->status === 'aktif') ? 'tidak aktif' : 'aktif';
        $member->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Status anggota ' . $member->name . ' diubah menjadi ' . $newStatus
        ]);
    }

    public function destroy(OrgMember $member)
    {
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus');
    }

    public function publicIndex(Request $request)
    {
        $periods = \App\Models\Period::latest()->get();
        $selectedPeriodId = $request->get('period_id');
        
        if ($selectedPeriodId) {
            $activePeriod = \App\Models\Period::find($selectedPeriodId);
        } else {
            $activePeriod = \App\Models\Period::where('is_active', true)->first() ?? $periods->first();
        }

        $members = collect();
        if ($activePeriod) {
            $members = OrgMember::where('period_id', $activePeriod->id)
                ->where(function($q) {
                    $q->where('status', 'aktif')->orWhereNull('status');
                })
                ->with(['position', 'division'])
                ->orderBy('order')
                ->get();
        }

        $pengurusInti = $members->filter(function ($m) {
            return $m->position && $m->position->type === 'inti';
        });

        $divisions = Division::where('is_active', true)->with(['members' => function ($q) use ($activePeriod) {
            if ($activePeriod) {
                $q->where('period_id', $activePeriod->id);
            }
            $q->where(function($subQ) {
                $subQ->where('status', 'aktif')->orWhereNull('status');
            })->with('position')->orderBy('order');
        }])->orderBy('order')->get();

        return view('struktur-organisasi', compact('pengurusInti', 'divisions', 'periods', 'activePeriod'));
    }
}
