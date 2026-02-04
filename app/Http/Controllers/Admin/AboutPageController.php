<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// deleted duplicate
use App\Models\AboutPage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function index()
    {
        $pages = AboutPage::latest()->get();
        return view('admin.about-pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.about-pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|max:10240', // Validate array of images
            'key' => 'nullable|string|unique:about_pages,key',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $count = 1;
        while (AboutPage::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Create the page
        $aboutPage = AboutPage::create($data);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('about_pages', 'public');
                $aboutPage->images()->create(['image' => $path]);
            }
            // Check if we also need to set the legacy 'image' column for backward compatibility or first image
            // Let's set the first image as the 'main' image if the column exists, just in case
            $aboutPage->update(['image' => $aboutPage->images->first()->image ?? null]);
        }

        return redirect()->route('admin.about-pages.index')->with('success', 'Halaman berhasil dibuat.');
    }

    public function edit(AboutPage $aboutPage)
    {
        return view('admin.about-pages.edit', compact('aboutPage'));
    }

    public function update(Request $request, AboutPage $aboutPage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|max:10240',
            'key' => 'nullable|string|unique:about_pages,key,' . $aboutPage->id,
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($aboutPage->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);
            $originalSlug = $data['slug'];
            $count = 1;
            while (AboutPage::where('slug', $data['slug'])->where('id', '!=', $aboutPage->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('about_pages', 'public');
                $aboutPage->images()->create(['image' => $path]);
            }
        }

        // Handle image deletion (if delete_images array is passed)
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $img = $aboutPage->images()->find($imageId);
                if ($img) {
                    Storage::disk('public')->delete($img->image);
                    $img->delete();
                }
            }
        }

        // Update main image fallback
        $aboutPage->refresh(); // Reload relations
        $data['image'] = $aboutPage->images->first()->image ?? null;

        $aboutPage->update($data);

        return redirect()->route('admin.about-pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(AboutPage $aboutPage)
    {
        if ($aboutPage->image) {
            Storage::disk('public')->delete($aboutPage->image);
        }
        $aboutPage->delete();
        return redirect()->route('admin.about-pages.index')->with('success', 'Halaman berhasil dihapus.');
    }
}
