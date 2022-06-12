<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;

class ProjectViewForm extends Component
{
    public $project;

    public function render()
    {
        return view('livewire.projects.project-view-form');
    }
}
