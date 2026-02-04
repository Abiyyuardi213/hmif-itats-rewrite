<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// duplicate removed
use App\Models\AboutPage;

class AboutController extends Controller
{
    public function index()
    {
        // Fetch all active pages
        $pages = AboutPage::where('is_active', true)->get();

        // Optional: helper to easily find specific pages in view, e.g. $pages->where('key', 'visi-misi')->first()

        return view('about', compact('pages'));
    }
}
