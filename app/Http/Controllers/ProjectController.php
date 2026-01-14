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
            $query->where('nama_proyek', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('jenis_proyek', 'like', "%{$search}%")
                  ->orWhere('tim_pengembang', 'like', "%{$search}%");
        }

        $projects = $query->orderBy('tahun_proyek', 'desc')->orderBy('nama_proyek')->get();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:200',
            'tahun_proyek' => 'required|integer',
            'jenis_proyek' => 'required|string|max:50',
            'tim_pengembang' => 'required|string',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string',
            'gambar' => 'nullable|file|image|max:2048',
            'status' => 'required|in:active,inactive',
            'video_source' => 'required|in:file,link',
            'video_demo' => 'nullable|required_if:video_source,file|file|mimes:mp4,avi,mpeg|max:204800',
            'video_link' => 'nullable|required_if:video_source,link|url',
        ]);

        $data = $request->except(['gambar', 'video_demo', 'video_link', 'video_source', 'image', 'video']); # Exclude old names too just in case input name hasn't changed in view yet, but better to handle view later. Wait, request keys depend on view input names. I MUST UPDATE VIEWS LATER.
        
        # MAPPING INPUT (old view names) to COLUMN (new db names) if view is not updated yet.
        # But safest is to Assume I will update View inputs too.
        # Let's assume view inputs will be updated to match column names.
        
        $data = $request->except(['gambar', 'video_demo', 'video_link', 'video_source']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/projects', 'public');
        }

        if ($request->video_source === 'file' && $request->hasFile('video_demo')) {
            $data['video_demo'] = $request->file('video_demo')->store('uploads/videos', 'public');
        } elseif ($request->video_source === 'link' && $request->video_link) {
            $data['video_demo'] = $request->video_link;
        }

        Project::create($data);

        Project::create($data);

        return response()->json(['message' => 'Proyek berhasil ditambahkan.', 'status' => 'success']);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:200',
            'tahun_proyek' => 'required|integer',
            'jenis_proyek' => 'required|string|max:50',
            'tim_pengembang' => 'required|string',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string',
            'gambar' => 'nullable|file|image|max:2048',
            'status' => 'required|in:active,inactive',
            'video_source' => 'required|in:file,link',
            'video_demo' => 'nullable|required_if:video_source,file|file|mimes:mp4,avi,mpeg|max:204800',
            'video_link' => 'nullable|required_if:video_source,link|url',
        ]);

        $data = $request->except(['gambar', 'video_demo', 'video_link', 'video_source']);

        if ($request->hasFile('gambar')) {
            if ($project->gambar && Storage::disk('public')->exists($project->gambar)) {
                Storage::disk('public')->delete($project->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('uploads/projects', 'public');
        }

        if ($request->video_source === 'file') {
            if ($request->hasFile('video_demo')) {
                // Delete old video if exists (file or no file, if it was a file path)
                if ($project->video_demo && !filter_var($project->video_demo, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($project->video_demo)) {
                    Storage::disk('public')->delete($project->video_demo);
                }
                $data['video_demo'] = $request->file('video_demo')->store('uploads/videos', 'public');
            }
        } elseif ($request->video_source === 'link') {
            // Check if user provided a new link or kept it same (though validation requires url)
            if ($request->video_link) {
                 // Delete old video file if it existed
                if ($project->video_demo && !filter_var($project->video_demo, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($project->video_demo)) {
                    Storage::disk('public')->delete($project->video_demo);
                }
                $data['video_demo'] = $request->video_link;
            }
        }

        $project->update($data);

        $project->update($data);

        return response()->json(['message' => 'Proyek berhasil diperbarui.', 'status' => 'success']);
    }

    public function destroy(Project $project)
    {
        if ($project->gambar && Storage::disk('public')->exists($project->gambar)) {
            Storage::disk('public')->delete($project->gambar);
        }
        if ($project->video_demo && Storage::disk('public')->exists($project->video_demo)) {
            Storage::disk('public')->delete($project->video_demo);
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
