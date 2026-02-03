<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('order')->get();
        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:inti,divisi',
            'order' => 'required|integer',
        ]);

        Position::create($validated);
        return redirect()->route('admin.positions.index')->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function edit(Position $position)
    {
        return view('admin.positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:inti,divisi',
            'order' => 'required|integer',
        ]);

        $position->update($validated);
        return redirect()->route('admin.positions.index')->with('success', 'Jabatan berhasil diperbarui');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('admin.positions.index')->with('success', 'Jabatan berhasil dihapus');
    }
}
