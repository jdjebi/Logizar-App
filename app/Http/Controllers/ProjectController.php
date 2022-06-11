<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class ProjectController extends Controller
{

    public function create(){
        return view("project.project_create");
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

        $request->session()->flash('flash.banner', 'Projet créé !');
        
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route("dashboard");

    }

}