<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Skill Management
Route::resource('skills', SkillController::class)->except(['create', 'show', 'edit']); // Using modals
Route::post('skills/{skill}/toggle', [SkillController::class, 'toggle'])->name('skills.toggle');

// Project Management
Route::resource('projects', ProjectController::class)->except(['create', 'edit']); // Using modals
Route::post('projects/{project}/toggle', [ProjectController::class, 'toggle'])->name('projects.toggle');
