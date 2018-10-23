<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    
    {
        $projects = Project::all();
        
        return view('projects.index', ['projects' => $projects]);
    }
    
    public function create()
    
    {
        $projects = Project::all();
        
        return view('projects.create', ['projects' => $projects]);
    }
    
    public function store()
    
    {
        Project::create(request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:10']
            ]));
        
        return redirect('/projects');
        
    }
    
    public function edit(Project $project)
    
    {
        
        return view('projects.edit', compact('project'));        

    }
    
    public function update(Project $project)
    
    {
        
        $project->title = request('title');
        $project->description = request('description');
        $project->save();
        return redirect('/projects');
        
    }
    
    public function destroy(Project $project)
    
    {
        
        $project->delete();
        return redirect('/projects');
        
    }
    
    public function show(Project $project)
    
    {
        return view('projects.show', compact('project'));                
    }
}
