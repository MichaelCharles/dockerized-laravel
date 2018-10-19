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
        $project = new Project();
        
        $project->title = request('title');
        
        $project->description = request('description');
        
        $project->save();
        
        return redirect('/projects');
        
    }
}
