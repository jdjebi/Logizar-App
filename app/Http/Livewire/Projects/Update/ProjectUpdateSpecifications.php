<?php

namespace App\Http\Livewire\Projects\Update;

use Livewire\Component;
use App\Models\ProjectType;
use App\Models\ProjectDeliverable;

class ProjectUpdateSpecifications extends Component
{
    public $project;

    public $is_opensource = false;
    public $type_id;
    public $deliverable_id;

    public $project_types = [];
    public $project_deliverables = [];

    protected $rules = [
        'type_id' => 'required',
        'deliverable_id' => 'required',
        'is_opensource' => 'boolean'
    ];

    public function mount()
    {
        $this->project_types = ProjectType::orderBy("name")->get();
        $this->project_deliverables = ProjectDeliverable::orderBy("name")->get();

        $this->type_id = $this->project->type_id;
        $this->is_opensource = $this->project->is_opensource;
        $this->deliverable_id = $this->project->deliverable_id;
    }

    public function submit()
    {

        $this->validate();

        // Preparation de l'enregistrement
        if ($this->type_id == "other") {
            $this->type_id = null;
        }

        if ($this->deliverable_id == "other") {
            $this->deliverable_id = null;
        }

        $this->project->is_opensource = $this->is_opensource;
        $this->project->type_id = $this->type_id;
        $this->project->deliverable_id = $this->deliverable_id;
        $this->project->save();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Spécifications mises à jour !"
        ]);
    }

    public function render()
    {
        return view('livewire.projects.update.project-update-specifications');
    }
}
