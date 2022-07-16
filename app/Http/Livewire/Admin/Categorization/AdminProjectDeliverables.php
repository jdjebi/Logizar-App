<?php

namespace App\Http\Livewire\Admin\Categorization;

use Livewire\Component;
use App\Models\ProjectDeliverable;
use Illuminate\Validation\Rule;

class AdminProjectDeliverables extends Component
{
    public $uiOpenCreateModal = false;
    public $uiOpenUpdateModal = false;
    public $uiOpenDeleteModal = false;

    public $name;
    public $shortname;
    public $description;
    public $deliverables;

    public $deliverableSelected;

    public $rules = [
        "name" => "required|max:30|unique:project_types",
        "shortname" => "max:30",
        "description" => "max:100"
    ];

    public function mount()
    {
        $this->deliverables = ProjectDeliverable::orderByDesc("name")->get();
    }

    public function openCreateModal()
    {
        $this->reset(['name', 'shortname', 'description']);
        $this->resetValidation();
        $this->uiOpenCreateModal = true;
    }

    public function openUpdateModal(ProjectDeliverable $type)
    {
        $this->deliverableSelected = $type;
        $this->name = $type->name;
        $this->shortname = $type->shortname;
        $this->description = $type->description;
        $this->resetValidation();
        $this->uiOpenUpdateModal = true;
    }

    public function openDeleteModal(ProjectDeliverable $type)
    {
        $this->deliverableSelected = $type;
        $this->uiOpenDeleteModal = true;
    }

    public function create()
    {
        $this->validate();
        $deliverableProject = new ProjectDeliverable;
        $deliverableProject->name = $this->name;
        $deliverableProject->shortname = $this->shortname;
        $deliverableProject->description = $this->description;
        $deliverableProject->save();
        $this->uiOpenCreateModal = false;
        $this->deliverables = ProjectDeliverable::orderByDesc("created_at")->get();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Type ajouté !"
        ]);
    }

    public function update()
    {
        $this->validate([
            "name" => [
                "required",
                "max:30",
                Rule::unique('project_types')->ignore($this->deliverableSelected->id),
            ],
            "shortname" => "max:30",
            "description" => "max:100"
        ]);

        $this->deliverableSelected->name = $this->name;
        $this->deliverableSelected->shortname = $this->shortname;
        $this->deliverableSelected->description = $this->description;
        $this->deliverableSelected->save();
        $this->deliverables = ProjectDeliverable::orderByDesc("created_at")->get();
        $this->uiOpenUpdateModal = false;
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Type modifié !"
        ]);
    }

    public function delete(){
        $this->deliverableSelected->delete();
        $this->deliverables = ProjectDeliverable::orderByDesc("created_at")->get();
        $this->uiOpenDeleteModal = false;
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> "Type supprimée !"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.categorization.admin-project-deliverables');
    }
}
