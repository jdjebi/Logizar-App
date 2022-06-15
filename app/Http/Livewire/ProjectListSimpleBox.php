<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectListSimpleBox extends Component
{
    public $projects;

    public function mount(){
        $this->projects = Project::orderByDesc("created_at")->get();
    }

    public function render()
    {
        return view('livewire.project-list-simple-box');
    }
}