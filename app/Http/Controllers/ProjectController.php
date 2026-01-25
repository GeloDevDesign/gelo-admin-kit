<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepositoryInterface $projectRepository
    ) {}
   
    public function index()
    {
        return Inertia::render('Home', [
            'projects' => $this->projectRepository->getAll()
        ]);
    }

    // CREATE
    public function store(Request $request)
    {
      
        $validated = $request->validate(['name' => 'required|string']);
        $this->projectRepository->create($validated);
        return to_route('projects.index'); 
    }

    // UPDATE
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate(['status' => 'required|string']);
        $this->projectRepository->update($project, $validated);
        
        return to_route('projects.index');
    }

    // DELETE
    public function destroy(Project $project)
    {
        $this->projectRepository->delete($project);
        return to_route('projects.index');
    }
}