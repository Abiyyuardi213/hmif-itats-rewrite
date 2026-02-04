<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityReport;
use App\Models\WorkProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActivityReportController extends Controller
{
    public function index()
    {
        $reports = ActivityReport::with('workProgram')->latest()->get();
        return view('admin.activity-reports.index', compact('reports'));
    }

    public function create()
    {
        $programs = WorkProgram::orderBy('start_date', 'desc')->get();
        return view('admin.activity-reports.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'work_program_id' => 'required|exists:work_programs,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $count = 1;
        while (ActivityReport::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('activity_reports', 'public');
        }

        if ($request->status == 'published' && !$request->published_at) {
            $data['published_at'] = now();
        }

        ActivityReport::create($data);

        return redirect()->route('admin.activity-reports.index')->with('success', 'Laporan kegiatan berhasil dibuat.');
    }

    public function edit(ActivityReport $activityReport)
    {
        $programs = WorkProgram::orderBy('start_date', 'desc')->get();
        return view('admin.activity-reports.edit', compact('activityReport', 'programs'));
    }

    public function update(Request $request, ActivityReport $activityReport)
    {
        $request->validate([
            'work_program_id' => 'required|exists:work_programs,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($activityReport->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);
            $originalSlug = $data['slug'];
            $count = 1;
            while (ActivityReport::where('slug', $data['slug'])->where('id', '!=', $activityReport->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        if ($request->hasFile('image')) {
            if ($activityReport->image) {
                Storage::disk('public')->delete($activityReport->image);
            }
            $data['image'] = $request->file('image')->store('activity_reports', 'public');
        }

        $activityReport->update($data);

        return redirect()->route('admin.activity-reports.index')->with('success', 'Laporan kegiatan berhasil diperbarui.');
    }

    public function destroy(ActivityReport $activityReport)
    {
        if ($activityReport->image) {
            Storage::disk('public')->delete($activityReport->image);
        }
        $activityReport->delete();
        return redirect()->route('admin.activity-reports.index')->with('success', 'Laporan kegiatan berhasil dihapus.');
    }
}
