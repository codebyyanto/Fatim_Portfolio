<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $query = Skill::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_keahlian', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $skills = $query->orderBy('nama_keahlian')->get();

        return view('skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_keahlian' => 'required|string|max:100|unique:tbkeahlian_23312241,nama_keahlian',
            'kategori_23312241' => 'required|string|in:Programming Language,Web Development,Mobile Development,Database,UI/UX Design,Desain Grafis dan Multimedia,Jaringan,Data Analis',
            'deskripsi' => 'required|string',
            'icon' => 'required|file|image|max:2048', // Required on create
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['nama_keahlian', 'kategori_23312241', 'deskripsi', 'status']);
        
        // Handle Icon Upload
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('uploads/icons', 'public');
            $data['icon'] = $path;
        }

        Skill::create($data);

        Skill::create($data);

        return response()->json(['message' => 'Keahlian berhasil ditambahkan.', 'status' => 'success']);
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'nama_keahlian' => 'required|string|max:100|unique:tbkeahlian_23312241,nama_keahlian,'.$skill->id,
            'kategori_23312241' => 'required|string|in:Programming Language,Web Development,Mobile Development,Database,UI/UX Design,Desain Grafis dan Multimedia,Jaringan,Data Analis',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|file|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['nama_keahlian', 'kategori_23312241', 'deskripsi', 'status']);

        if ($request->hasFile('icon')) {
            // Delete old icon if exists and is not a font-awesome class
            if ($skill->icon && !str_starts_with($skill->icon, 'fa-') && Storage::disk('public')->exists($skill->icon)) {
                Storage::disk('public')->delete($skill->icon);
            }
            
            $path = $request->file('icon')->store('uploads/icons', 'public');
            $data['icon'] = $path;
        }

        $skill->update($data);

        $skill->update($data);

        return response()->json(['message' => 'Keahlian berhasil diperbarui.', 'status' => 'success']);
    }

    public function destroy(Skill $skill)
    {
        if ($skill->icon && !str_starts_with($skill->icon, 'fa-') && Storage::disk('public')->exists($skill->icon)) {
            Storage::disk('public')->delete($skill->icon);
        }
        
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Keahlian berhasil dihapus.');
    }

    public function toggle(Skill $skill)
    {
        $skill->status = $skill->status === 'active' ? 'inactive' : 'active';
        $skill->save();
        return redirect()->route('skills.index')->with('success', 'Status keahlian diperbarui.');
    }
}
