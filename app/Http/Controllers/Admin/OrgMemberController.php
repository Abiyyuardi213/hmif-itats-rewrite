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
    public function index()
    {
        $members = OrgMember::with(['position', 'division'])->orderBy('order')->paginate(10);
        $positions = Position::orderBy('order')->get();
        $divisions = Division::orderBy('order')->get();
        return view('admin.members.index', compact('members', 'positions', 'divisions'));
    }

    public function create()
    {
        $positions = Position::orderBy('order')->get();
        $divisions = Division::orderBy('order')->get();
        return view('admin.members.create', compact('positions', 'divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'nullable|string|max:20',
            'position_id' => 'required|exists:positions,id',
            'division_id' => 'nullable|exists:divisions,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('members', 'public');
        }

        OrgMember::create($validated);

        if ($request->wantsJson()) {
            session()->flash('success', 'Anggota berhasil ditambahkan');
            return response()->json(['message' => 'Success']);
        }

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit(OrgMember $member)
    {
        $positions = Position::orderBy('order')->get();
        $divisions = Division::orderBy('order')->get();
        return view('admin.members.edit', compact('member', 'positions', 'divisions'));
    }

    public function update(Request $request, OrgMember $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'nullable|string|max:20',
            'position_id' => 'required|exists:positions,id',
            'division_id' => 'nullable|exists:divisions,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'required|integer',
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

    public function destroy(OrgMember $member)
    {
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus');
    }

    public function publicIndex()
    {
        $members = OrgMember::with(['position', 'division'])->orderBy('order')->get();

        $pengurusInti = $members->filter(function ($m) {
            return $m->position->type === 'inti';
        });

        $divisions = Division::with(['members' => function ($q) {
            $q->with('position')->orderBy('order');
        }])->orderBy('order')->get();

        return view('struktur-organisasi', compact('pengurusInti', 'divisions'));
    }
}
