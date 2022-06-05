<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProjectUserListSimpleBox extends Component
{    
    public $user;

    public function mount($user){
        $this->user = $user;
    }

    public function render()
    {
        $projects =  $this->user->projects;

        return view('livewire.project-user-list-simple-box',[
            "projects" => $projects
        ]);
    }
}
