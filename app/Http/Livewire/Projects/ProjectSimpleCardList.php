<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;

class ProjectSimpleCardList extends Component
{
    public function render()
    {
        $projects = Project::orderByDesc("created_at")->get();

        return view('livewire.projects.project-simple-card-list',[
            "projects" => $projects
        ]);
    }
}
