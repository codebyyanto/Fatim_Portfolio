<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('team', 'like', "%{$search}%");
        }

        $projects = $query->orderBy('year', 'desc')->orderBy('name')->get();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'year' => 'required|integer',
            'type' => 'required|string|max:50',
            'team' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'image' => 'nullable|file|image|max:2048',
            'status' => 'required|in:active,inactive',
            'video_source' => 'required|in:file,link',
            'video' => 'nullable|required_if:video_source,file|file|mimes:mp4,avi,mpeg|max:204800',
            'video_link' => 'nullable|required_if:video_source,link|url',
        ]);

        $data = $request->except(['image', 'video', 'video_link', 'video_source']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/projects', 'public');
        }

        if ($request->video_source === 'file' && $request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('uploads/videos', 'public');
        } elseif ($request->video_source === 'link' && $request->video_link) {
            $data['video'] = $request->video_link;
        }

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'year' => 'required|integer',
            'type' => 'required|string|max:50',
            'team' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'image' => 'nullable|file|image|max:2048',
            'status' => 'required|in:active,inactive',
            'video_source' => 'required|in:file,link',
            'video' => 'nullable|required_if:video_source,file|file|mimes:mp4,avi,mpeg|max:204800',
            'video_link' => 'nullable|required_if:video_source,link|url',
        ]);

        $data = $request->except(['image', 'video', 'video_link', 'video_source']);

        if ($request->hasFile('image')) {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('uploads/projects', 'public');
        }

        if ($request->video_source === 'file') {
            if ($request->hasFile('video')) {
                // Delete old video if exists (file or no file, if it was a file path)
                if ($project->video && !filter_var($project->video, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($project->video)) {
                    Storage::disk('public')->delete($project->video);
                }
                $data['video'] = $request->file('video')->store('uploads/videos', 'public');
            }
        } elseif ($request->video_source === 'link') {
            // Check if user provided a new link or kept it same (though validation requires url)
            if ($request->video_link) {
                 // Delete old video file if it existed
                if ($project->video && !filter_var($project->video, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($project->video)) {
                    Storage::disk('public')->delete($project->video);
                }
                $data['video'] = $request->video_link;
            }
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }
        if ($project->video && Storage::disk('public')->exists($project->video)) {
            Storage::disk('public')->delete($project->video);
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    public function toggle(Project $project)
    {
        $project->status = $project->status === 'active' ? 'inactive' : 'active';
        $project->save();
        return redirect()->route('projects.index')->with('success', 'Status proyek diperbarui.');
    }
}
