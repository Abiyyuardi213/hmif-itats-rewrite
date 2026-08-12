<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::orderBy('order')->get();
        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        if (empty($validated['icon'])) {
            $validated['icon'] = $this->getDefaultIcon($validated['name']);
        }
        if (empty($validated['color'])) {
            $validated['color'] = $this->getDefaultColor($validated['name']);
        }

        Division::create($validated);
        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil ditambahkan');
    }

    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : false;

        if (empty($validated['icon'])) {
            $validated['icon'] = $this->getDefaultIcon($validated['name']);
        }
        if (empty($validated['color'])) {
            $validated['color'] = $this->getDefaultColor($validated['name']);
        }

        $division->update($validated);
        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil diperbarui');
    }

    public function toggleStatus(Request $request, Division $division)
    {
        $validated = $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $division->update([
            'is_active' => $validated['is_active'],
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Status divisi berhasil diperbarui.',
                'is_active' => $division->is_active,
            ]);
        }

        return redirect()->back()->with('success', 'Status divisi berhasil diperbarui.');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil dihapus');
    }

    private function getDefaultIcon(string $name): string
    {
        $lower = strtolower($name);
        if (str_contains($lower, 'bph') || str_contains($lower, 'inti') || str_contains($lower, 'pengurus')) {
            return 'fa-users';
        }
        if (str_contains($lower, 'litbang') || str_contains($lower, 'riset') || str_contains($lower, 'tekno') || str_contains($lower, 'dev')) {
            return 'fa-laptop-code';
        }
        if (str_contains($lower, 'media') || str_contains($lower, 'kominfo') || str_contains($lower, 'humas') || str_contains($lower, 'info')) {
            return 'fa-bullhorn';
        }
        if (str_contains($lower, 'kewirausahaan') || str_contains($lower, 'danus') || str_contains($lower, 'ekonomi')) {
            return 'fa-coins';
        }
        if (str_contains($lower, 'bakat') || str_contains($lower, 'minat') || str_contains($lower, 'olahraga')) {
            return 'fa-trophy';
        }
        return 'fa-layer-group';
    }

    private function getDefaultColor(string $name): string
    {
        $lower = strtolower($name);
        if (str_contains($lower, 'bph') || str_contains($lower, 'inti')) {
            return 'bg-slate-800 text-white';
        }
        if (str_contains($lower, 'litbang') || str_contains($lower, 'riset')) {
            return 'bg-emerald-600 text-white';
        }
        if (str_contains($lower, 'media') || str_contains($lower, 'kominfo')) {
            return 'bg-purple-600 text-white';
        }
        if (str_contains($lower, 'humas')) {
            return 'bg-amber-600 text-white';
        }
        return 'bg-blue-600 text-white';
    }
}
