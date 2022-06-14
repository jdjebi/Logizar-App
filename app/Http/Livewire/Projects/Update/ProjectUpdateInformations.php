<?php

namespace App\Http\Livewire\Projects\Update;

use Livewire\Component;

class ProjectUpdateInformations extends Component
{
    public $name;
    public $description;
    public $summary;
    public $project; 

    protected $rules = [
        'name' => 'required|max:30',
        'summary' => 'required|max:70',
        'description' => 'required'
    ];

    public function mount($project)
    {
        $this->name = $project->name;
        $this->summary = $project->summary;
        $this->description = $project->description;
    }

    public function submit()
    { 
        $this->validate();
        $this->project->name = $this->name;
        $this->project->description = $this->description;
        $this->project->summary = $this->summary;
        $this->project->save();
        session()->flash('flash.banner', 'Description du projet mise à jour !');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route("project.update",$this->project->id);
    }

    public function render()
    {
        return view('livewire.projects.update.project-update-informations');
    }
}