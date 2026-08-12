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
        // Ensure default Visi & Misi Program Studi page exists
        AboutPage::firstOrCreate(
            ['key' => 'visi-misi'],
            [
                'title' => 'Visi & Misi Program Studi',
                'subtitle' => 'Akademik',
                'slug' => 'visi-misi-program-studi',
                'content' => '<h3>Visi</h3><p>Menjadi program studi yang menghasilkan lulusan inovatif, berwawasan lingkungan, dan berkelanjutan di bidang rekayasa perangkat lunak terintegrasi, pembelajaran mesin, serta manajemen jaringan komputer di tingkat regional untuk mencapai reputasi internasional pada 2045.</p><h3>Misi</h3><ol><li>Menyelenggarakan pendidikan tinggi yang unggul dan adaptif dalam bidang rekayasa perangkat lunak terintegrasi, pembelajaran mesin, dan manajemen jaringan komputer, guna menghasilkan lulusan yang inovatif, beretika, dan berwawasan lingkungan.</li><li>Mengembangkan penelitian terapan dan inovatif di bidang informatika yang mendukung kemajuan sains dan teknologi informasi serta berkontribusi terhadap penyelesaian masalah di tingkat lokal, nasional, dan regional.</li><li>Melaksanakan pengabdian kepada masyarakat berbasis teknologi informasi yang mampu meningkatkan literasi digital, produktivitas masyarakat, serta menunjang pembangunan berkelanjutan.</li><li>Membangun kerja sama strategis dengan industri, pemerintah, dan lembaga pendidikan di dalam dan luar negeri guna meningkatkan daya saing lulusan dan reputasi internasional program studi.</li><li>Mendorong budaya inovasi, kewirausahaan, dan pembelajaran dalam lingkungan akademik yang inklusif, kolaboratif, dan mendukung keberlanjutan teknologi informasi di era transformasi digital.</li></ol>',
                'is_active' => true,
            ]
        );

        // Ensure default Visi & Misi Kabinet Reboot page exists
        AboutPage::firstOrCreate(
            ['key' => 'visi-misi-kabinet'],
            [
                'title' => 'Visi & Misi Kabinet REBOOT',
                'subtitle' => 'HMIF 2024/2025',
                'slug' => 'visi-misi-kabinet-reboot',
                'content' => '<h3>Visi Kabinet</h3><p>Terwujudnya Himpunan Mahasiswa Teknik Informatika (HMIF ITATS) sebagai wadah pergerakan yang inklusif, adaptif, profesional, dan berorientasi pada pengembangan potensi berasaskan kekeluargaan serta inovasi teknologi.</p><h3>Misi Kabinet</h3><ol><li>Memperkuat tata kelola internal organisasi secara profesional, transparan, dan akuntabel.</li><li>Menyediakan ruang kreasi, penelitian, dan inovasi teknologi bagi seluruh mahasiswa Teknik Informatika ITATS.</li><li>Mempererat tali kekeluargaan, solidaritas, dan kolaborasi antar mahasiswa, alumni, serta elemen akademis ITATS.</li><li>Meningkatkan peran aktif HMIF ITATS dalam kegiatan pengabdian masyarakat dan jejaring keorganisasian tingkat regional maupun nasional.</li></ol>',
                'is_active' => true,
            ]
        );

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
            'subtitle' => 'nullable|string|max:255',
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
            'subtitle' => 'nullable|string|max:255',
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
