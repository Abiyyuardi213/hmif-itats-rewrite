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
        ]);

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
        ]);

        $division->update($validated);
        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil diperbarui');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil dihapus');
    }
}
