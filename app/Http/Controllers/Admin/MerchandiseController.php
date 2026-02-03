<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    public function index()
    {
        $merchandises = Merchandise::latest()->get();
        return view('admin.merchandises.index', compact('merchandises'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'sizes' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->name) . '-' . Str::random(5);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('merchandises', 'public');
        }

        Merchandise::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, Merchandise $merchandise)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'sizes' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
        ]);

        if ($request->name !== $merchandise->name) {
            $validated['slug'] = Str::slug($request->name) . '-' . Str::random(5);
        }

        if ($request->hasFile('image')) {
            if ($merchandise->image) {
                Storage::disk('public')->delete($merchandise->image);
            }
            $validated['image'] = $request->file('image')->store('merchandises', 'public');
        }

        $merchandise->update($validated);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Merchandise $merchandise)
    {
        if ($merchandise->image) {
            Storage::disk('public')->delete($merchandise->image);
        }
        $merchandise->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
