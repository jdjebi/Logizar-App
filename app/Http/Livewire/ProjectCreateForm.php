<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProjectCreateForm extends Component
{
    public $message;
    
    public function render()
    {
        return view('livewire.project.project-create-form');
    }
}
