<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Project;

class ProjectCreateForm extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|max:30',
        'description' => 'required'
    ];

    public function submit()
    { 
        Log::debug("test");

        $this->validate(); 


        $project = new Project;

        $project->name = $this->name;

        $project->description = $this->description;

        $project->user_id = Auth::id();

        $project->save();
        
        session()->flash('flash.banner', 'Projet créé !');
        
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route("dashboard");
    }
    
    public function render()
    {
        return view('livewire.project.project-create-form');
    }
}
