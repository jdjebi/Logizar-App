<?php

namespace App\Http\Livewire\Projects\Delete;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectDeleteButton extends Component
{
    public $project;

    public $ui_confirming_user_deletion = false;

    public function delete(){       
        if(Auth::user()->id == $this->project->user_id){
            session()->flash('flash.banner', 'Projet supprimé');
            session()->flash('flash.bannerStyle', 'success');
        }else{
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Action non autorisée"
            ]);
            $this->ui_confirming_user_deletion = false;
        }
    }

    public function openConfirmDeletionModal(){
        $this->ui_confirming_user_deletion = true;
    }

    public function render(){
        return view('livewire.projects.delete.project-delete-button');
    }
}
