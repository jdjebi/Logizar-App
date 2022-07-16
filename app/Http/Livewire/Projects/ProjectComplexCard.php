<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;

class ProjectComplexCard extends Component
{
    public $project;
    
    public function render()
    {
        return view('livewire.projects.project-complex-card');
    }
}
