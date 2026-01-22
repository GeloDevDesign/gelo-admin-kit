<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
   
    public function index()
    {
 
        return Inertia::render('Home');
    }

    // CREATE
    public function store(Request $request)
    {
      
        $validated = $request->validate(['name' => 'required|string']);
        Project::create($validated);
        return to_route('projects.index'); 
    }

    // UPDATE
    public function update(Request $request, Project $project)
    {
        dd($request->all());
        $validated = $request->validate(['status' => 'required|string']);
        $project->update($validated);
        
        return to_route('projects.index');
    }

    // DELETE
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('projects.index');
    }
}