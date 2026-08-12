<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// duplicate removed
use App\Models\AboutPage;

class AboutController extends Controller
{
    public function index()
    {
        // Ensure default Visi & Misi Program Studi page exists in database
        $visiMisi = AboutPage::firstOrCreate(
            ['key' => 'visi-misi'],
            [
                'title' => 'Visi & Misi Program Studi',
                'subtitle' => 'Akademik',
                'slug' => 'visi-misi-program-studi',
                'content' => '<h3>Visi</h3><p>Menjadi program studi yang menghasilkan lulusan inovatif, berwawasan lingkungan, dan berkelanjutan di bidang rekayasa perangkat lunak terintegrasi, pembelajaran mesin, serta manajemen jaringan komputer di tingkat regional untuk mencapai reputasi internasional pada 2045.</p><h3>Misi</h3><ol><li>Menyelenggarakan pendidikan tinggi yang unggul dan adaptif dalam bidang rekayasa perangkat lunak terintegrasi, pembelajaran mesin, dan manajemen jaringan komputer, guna menghasilkan lulusan yang inovatif, beretika, dan berwawasan lingkungan.</li><li>Mengembangkan penelitian terapan dan inovatif di bidang informatika yang mendukung kemajuan sains dan teknologi informasi serta berkontribusi terhadap penyelesaian masalah di tingkat lokal, nasional, dan regional.</li><li>Melaksanakan pengabdian kepada masyarakat berbasis teknologi informasi yang mampu meningkatkan literasi digital, produktivitas masyarakat, serta menunjang pembangunan berkelanjutan.</li><li>Membangun kerja sama strategis dengan industri, pemerintah, dan lembaga pendidikan di dalam dan luar negeri guna meningkatkan daya saing lulusan dan reputasi internasional program studi.</li><li>Mendorong budaya inovasi, kewirausahaan, dan pembelajaran dalam lingkungan akademik yang inklusif, kolaboratif, dan mendukung keberlanjutan teknologi informasi di era transformasi digital.</li></ol>',
                'is_active' => true,
            ]
        );

        // Ensure default Visi & Misi Kabinet Reboot page exists in database
        $visiMisiKabinet = AboutPage::firstOrCreate(
            ['key' => 'visi-misi-kabinet'],
            [
                'title' => 'Visi & Misi Kabinet REBOOT',
                'subtitle' => 'HMIF 2024/2025',
                'slug' => 'visi-misi-kabinet-reboot',
                'content' => '<h3>Visi Kabinet</h3><p>Terwujudnya Himpunan Mahasiswa Teknik Informatika (HMIF ITATS) sebagai wadah pergerakan yang inklusif, adaptif, profesional, dan berorientasi pada pengembangan potensi berasaskan kekeluargaan serta inovasi teknologi.</p><h3>Misi Kabinet</h3><ol><li>Memperkuat tata kelola internal organisasi secara profesional, transparan, dan akuntabel.</li><li>Menyediakan ruang kreasi, penelitian, dan inovasi teknologi bagi seluruh mahasiswa Teknik Informatika ITATS.</li><li>Mempererat tali kekeluargaan, solidaritas, dan kolaborasi antar mahasiswa, alumni, serta elemen akademis ITATS.</li><li>Meningkatkan peran aktif HMIF ITATS dalam kegiatan pengabdian masyarakat dan jejaring keorganisasian tingkat regional maupun nasional.</li></ol>',
                'is_active' => true,
            ]
        );

        $visiMisi->load('images');
        $visiMisiKabinet->load('images');

        // Fetch all active pages excluding dedicated Visi Misi sections
        $pages = AboutPage::with('images')
            ->where('is_active', true)
            ->whereNotIn('id', [$visiMisi->id, $visiMisiKabinet->id])
            ->get();

        return view('about', compact('pages', 'visiMisi', 'visiMisiKabinet'));
    }
}
