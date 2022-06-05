<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectListSimpleBox extends Component
{
    public function render()
    {
        $projects = Project::orderByDesc("created_at")->get();

        return view('livewire.project-list-simple-box',[
            "projects" => $projects
        ]);
    }
}
