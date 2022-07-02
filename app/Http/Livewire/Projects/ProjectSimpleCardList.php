<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectSimpleCardList extends Component
{

    public $projects;
    public $projectsDefault;

    protected $listeners = [
        'projectsSelectedByCategorizationSidebar' => 'refreshProjects',
        'ping' => 'test'
    ];

    public function mount(){
        $this->projects = $this->getAllProjects();
        $this->projectsDefault = $this->projects;
    }


    public function refreshProjects($keys){
        if(empty($keys)){
            $this->projects = $this->projectsDefault;
        }else{
            $data = Project::whereIn('id', function($query)  use ($keys){
                $query->select('projects.id')
                ->from('projects')
                ->join("project_category","project_category.project_id","=","projects.id")
                ->where('project_category.type', "system")
                ->whereIn('project_category.category_id', $keys)
                ->orderBy('projects.created_at', 'desc');      
            })->get();
            $this->projects = $data;
        }
    }

    public function getAllProjects(){
        return Project::orderByDesc("created_at")->get();
    }

    public function render(){
        return view('livewire.projects.project-simple-card-list');
    }
    
}
