<?php

namespace App\Http\Livewire\Admin\Categorization;

use Livewire\Component;
use App\Models\ProjectType;
use Illuminate\Validation\Rule;

class AdminTypesProject extends Component
{
    public $uiOpenCreateModal = false;
    public $uiOpenUpdateModal = false;
    public $uiOpenDeleteModal = false;

    public $name;
    public $shortname;
    public $description;
    public $types;

    public $typeSelected;

    public $rules = [
        "name" => "required|max:25|unique:project_types",
        "shortname" => "max:25",
        "description" => "max:100"
    ];

    public function mount()
    {
        $this->types = ProjectType::orderByDesc("name")->get();
    }

    public function openCreateModal()
    {
        $this->reset(['name', 'shortname', 'description']);
        $this->resetValidation();
        $this->uiOpenCreateModal = true;
    }

    public function openUpdateModal(ProjectType $type)
    {
        $this->typeSelected = $type;
        $this->name = $type->name;
        $this->shortname = $type->shortname;
        $this->description = $type->description;
        $this->resetValidation();
        $this->uiOpenUpdateModal = true;
    }

    public function openDeleteModal(ProjectType $type)
    {
        $this->typeSelected = $type;
        $this->uiOpenDeleteModal = true;
    }

    public function create()
    {
        $this->validate();
        $typeProject = new ProjectType;
        $typeProject->name = $this->name;
        $typeProject->shortname = $this->shortname;
        $typeProject->description = $this->description;
        $typeProject->save();
        $this->uiOpenCreateModal = false;
        $this->types = ProjectType::orderByDesc("created_at")->get();
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
                "max:25",
                Rule::unique('project_types')->ignore($this->typeSelected->id),
            ],
            "shortname" => "max:25",
            "description" => "max:100"
        ]);

        $this->typeSelected->name = $this->name;
        $this->typeSelected->shortname = $this->shortname;
        $this->typeSelected->description = $this->description;
        $this->typeSelected->save();
        $this->types = ProjectType::orderByDesc("created_at")->get();
        $this->uiOpenUpdateModal = false;
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Type modifié !"
        ]);
    }

    public function delete(){
        $this->typeSelected->delete();
        $this->types = ProjectType::orderByDesc("created_at")->get();
        $this->uiOpenDeleteModal = false;
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> "Type supprimée !"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.categorization.admin-types-project');
    }
}
