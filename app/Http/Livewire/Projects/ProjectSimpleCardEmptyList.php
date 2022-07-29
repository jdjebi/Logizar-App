<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;

class ProjectSimpleCardEmptyList extends Component
{

    public $projects;
    public $projectsDefault;
    public $show_counter = false;

    protected $listeners = [
        'projectsSelectedByCategorizationSidebar' => 'refreshProjects',
    ];

    public function mount($projects){
        $this->projects = $projects;
        $this->projectsDefault = $this->projects;
    }

    public function refreshProjects($data){
        $keys = $data["keys"];
        if(empty($keys)){
            $this->projects = $this->projectsDefault;
        }else{
            $ps = $this->projects;
            $this->projects = $ps->reject(function($p) use($keys){
                $pcs = $p->projectCategories()->get();
                $c_ids = $pcs->map(function($pc){
                    return $pc->category_id;
                });
                $c_ids = $c_ids->toArray();
                return count(array_intersect($c_ids, $keys)) ? false : true;
            });
        }
    }

    public function render()
    {
        return view('livewire.projects.project-simple-card-empty-list');
    }
}
