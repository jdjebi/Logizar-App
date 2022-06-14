<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;

class ProjectSimpleCard extends Component
{
    public $project;

    public function render()
    {
        return view('livewire.projects.project-simple-card');
    }
}
