<?php

namespace App\Http\Livewire\Projects\Update;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectUpdateInformations extends Component
{
    public $name;
    public $description;
    public $summary;
    public $project;
    public $code_name;

    public $baseUrl;
    public $codeNameIsUnique = true;

    protected function rules(){
        return [
            'name' => 'required|max:30',
            'summary' => 'required|max:70',
            'description' => 'required',
            'code_name' => [
                'required', 
                'max:45',
                Rule::unique('projects')->ignore($this->project->id),
            ]
        ];
    }

    public function mount($project)
    {
        $this->name = $project->name;
        $this->summary = $project->summary;
        $this->description = $project->description;
        $this->code_name = $project->code_name;
        $this->baseUrl = route("project.show.bycodename", $this->code_name);
    }

    public function generateCodeName()
    {
        if (empty($this->name)) {
            $this->code_name = "";
        } else {
            $this->code_name = Str::slug($this->name, ".");
        }

        error_log("test");

        $this->checkCodeNameUnicity();

    }

    public function checkCodeNameUnicity()
    {
        error_log("test");

        // Verifier si le code est unique
        $result = Project::where("code_name", $this->code_name)->where("code_name","!=",$this->project->code_name)->count();
        if ($result == 0) {
            // Cette condition supplémentaire permet d'éviter la mise à jour su la valeur n'a pas changé
            if ($this->codeNameIsUnique == false) {
                $this->codeNameIsUnique = true;
            }
        } else {
            if ($this->codeNameIsUnique == true) {
                $this->codeNameIsUnique = false;
            }
        }

        error_log($this->codeNameIsUnique);

    }

    public function submit()
    {
        $this->validate();

        // 

        $this->project->name = $this->name;
        $this->project->description = $this->description;
        $this->project->summary = $this->summary;
        $this->project->code_name = $this->code_name;
        $this->project->save();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Description mise à jour !"
        ]);
    }

    public function render()
    {
        return view('livewire.projects.update.project-update-informations');
    }
}
