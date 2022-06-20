<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Category;
use App\Models\OtherCategory;

class ProjectCreateForm extends Component
{
    public $categories;

    public $name;
    public $description;
    public $summary;

    public $categorySelectedId;
    public $otherCategoryContent;
    public $categoriesSelected = [];
    public $categoriesTabou = [];
    public $addCategoryDisabled = false;

    protected $rules = [
        'name' => 'required|max:30',
        'summary' => 'required|max:70',
        'description' => 'required'
    ];

    public function mount(){
        $this->categories = Category::orderBy("name")->get();

        /*
        if(count($this->categories) > 0){
            $this->categorySelectedId = $this->categories[0]->id;
        }
        */
    }

    public function addCategory(){  
    
        if(!empty($this->categorySelectedId)){

            if($this->categorySelectedId == "other" and !empty($this->otherCategoryContent)){
                $otherCategory = new OtherCategory;
                $otherCategory->name = $this->otherCategoryContent; 
                $otherCategory->type = "other";              
                $this->categoriesSelected[] = $otherCategory->toArray();
            }else{
                $category = $this->categories->find($this->categorySelectedId);
                $this->categoriesSelected[] = $category->toArray();
                $this->categoriesTabou[] = $category->id;
            }

            if(count($this->categoriesSelected) == 3){
                $this->addCategoryDisabled = true;
            }

            $this->reset("categorySelectedId");
            $this->reset("otherCategoryContent");
        }
    }

    public function removeCategory($key){
        $tkey = array_search($this->categoriesSelected[$key]["id"],$this->categoriesTabou);
        
        unset($this->categoriesSelected[$key]);

        if($tkey){
            unset($this->categoriesTabou[$tkey]);
        }

        $this->categoriesSelected = array_values($this->categoriesSelected);
        $this->categoriesTabou = array_values($this->categoriesTabou);

        if(count($this->categoriesSelected) == 2){
            $this->addCategoryDisabled = false;
        }
    }

    public function submit()
    { 

        error_log($this->name);
        error_log($this->description);
        error_log($this->summary);
        error_log(json_encode($this->categoriesSelected));

        return;

        $this->validate(); 

        // Faire un code de validation des catégories

        $project = new Project;
        $project->name = $this->name;
        $project->description = $this->description;
        $project->summary = $this->summary;
        $project->user_id = Auth::id();
        $project->save();
        
        session()->flash('flash.banner', 'Projet créé !');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route("dashboard");
    }
    
    public function render()
    {
        return view('livewire.project.project-create-form');
    }
}
