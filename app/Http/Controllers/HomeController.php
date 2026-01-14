<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $skills = Skill::where('status', 'active')->limit(12)->get();
        $projects = Project::where('status', 'active')->orderBy('tahun_proyek', 'desc')->limit(3)->get();

        return view('home', compact('skills', 'projects'));
    }
}
