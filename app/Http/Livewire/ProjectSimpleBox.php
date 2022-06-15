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
    public $project_id;

    public $uiConfirmingUserDeletion = false;

    public function mount($project){
        $this->project_id = $project->id;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->owner = $project->user;
        $this->created_at = $project->created_at->format('d/m/Y');
    }

    public function delete(){     

        $this->project->delete();

        session()->flash('flash.banner', 'Projet supprimé');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route("dashboard");
    }

    public function openConfirmDeletionModal(){
        $this->uiConfirmingUserDeletion = true;
    }

    public function render(){
        return view('livewire.project-simple-box');
    }

}