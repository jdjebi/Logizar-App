<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class ProjectController extends Controller
{

    public function create(){
        return view("project.create");
    }

    public function store(Request $request){

        // Validation

        $validated = $request->validate([
            'name' => 'required|max:30',
            'description' => 'required'
        ]);

        $project = new Project;

        $project->name = $request->name;

        $project->description = $request->description;

        $project->user_id = Auth::id();

        $project->save();

        session()->flash('flash.banner', 'Projet créé !');
    
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route("dashboard");

    }

    public function show(Request $request, $id){
        
        $project = Project::findOrFail($id);

        return view("project.project-show",[
            "project" => $project
        ]);

    }

    public function showPublic(Request $request, $id){
        
        $project = Project::findOrFail($id);

        return view("project.show-public",[
            "project" => $project
        ]);

    }

    public function update(Request $request, $id){
        
        $project = Project::findOrFail($id);

        return view("project.update",[
            "project" => $project
        ]);

    }

}