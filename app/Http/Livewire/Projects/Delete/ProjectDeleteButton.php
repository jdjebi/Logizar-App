<?php

namespace App\Http\Livewire\Projects\Delete;

use Livewire\Component;

class ProjectDeleteButton extends Component
{
    public $project;

    public $uiConfirmingUserDeletion = false;

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
        return view('livewire.projects.delete.project-delete-button');
    }
}
