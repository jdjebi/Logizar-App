<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProjectSimpleBox extends Component
{
    public $project;
    public $name;
    public $description;
    public $owner;
    public $created_at;

    public function mount($project){
        $this->name = $project->name;
        $this->description = $project->description;
        $this->owner = $project->user;
        $this->created_at = $project->created_at->format('d/m/Y');
    }

    public function render()
    {
        return view('livewire.project-simple-box');
    }
}