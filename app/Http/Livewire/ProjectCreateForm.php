<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Category;
use App\Models\OtherCategory;
use App\Models\ProjectCategory;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;

class ProjectCreateForm extends Component
{
    public $categories;

    public $name;
    public $description;
    public $summary;
    public $code_name;

    public $baseUrl;
    public $codeNameIsUnique = true;

    public $categorySelectedId;
    public $otherCategoryContent;
    public $categoriesSelected = [];
    public $categoriesTabou = [];
    public $addCategoryDisabled = false;
    protected $MAX_CATEGORY = 3;

    protected $rules = [
        'name' => 'required|max:30',
        'code_name' => 'required|regex:/^\w[-.\w]*\w$/|max:45|unique:projects',
        'summary' => 'required|max:70',
        'description' => 'required'
    ];

    public function mount(){
        $this->baseUrl = route("project.show.bycodename",[
            "code_name" => ""
        ]);
        $this->categories = Category::orderBy("name")->get();
    }

    public function addCategory(){  
    
        if(!empty($this->categorySelectedId)){

            if($this->categorySelectedId == "other"){
                if(!empty($this->otherCategoryContent)){
                    $otherCategory = new OtherCategory;
                    $otherCategory->id = null; 
                    $otherCategory->name = $this->otherCategoryContent; 
                    $otherCategory->type = "other";              
                    $this->categoriesSelected[] = $otherCategory->toArray();
                }
            }else{
                $category = $this->categories->find($this->categorySelectedId);
                $this->categoriesSelected[] = $category->toArray();
                $this->categoriesTabou[] = $category->id;
            }

            if(count($this->categoriesSelected) == $this->MAX_CATEGORY){
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

    public function generateCodeName(){
        if(empty($this->name)){
            $this->code_name = "";
        }else{
            $this->code_name = Str::slug($this->name,".");
        }
        $this->checkCodeNameUnicity();
    }

    public function checkCodeNameUnicity(){
        // Verifier si le code est unique
        $result = Project::where("code_name",$this->code_name)->count(); 
        error_log("d");
        error_log($result);
        error_log("d");
        if($result==0){
            // Cette condition supplémentaire permet d'éviter la mise à jour su la valeur n'a pas changé
            if($this->codeNameIsUnique == false){
                $this->codeNameIsUnique = true;
            }
        }else{
            if($this->codeNameIsUnique == true){
                $this->codeNameIsUnique = false;
            }
        }
    }

    public function submit()
    { 

        /*
            Cette methode de validation permet de valider les categories car elles ne sont pas champs du composant.
            Leur validation est donc faite après la validation des champs. Ici on vérifie les axes suivant :

            - Verifier qu'il y'a au moins une categorie
            - Verification de la repetition d'une categorie
            - Verifier que les catégories existent (sauf celle autre)
            - Vérifier que la catégorie autre possède une description
            - Vérifier la taille du nom des catégories, y compris celle de la catégorie autre
        */

        $this->withValidator(function (Validator $validator) {

            $validator->after(function ($validator) {
                   
                if(count($this->categoriesSelected) == 0){

                    $validator->errors()->add('categories.empty', 'Veuillez renseigner au moins une catégorie.');

                    foreach($this->categoriesSelected as $category){
                        
                        if($category->type == "other" && !empty($category->name)){

                            $validator->errors()->add('categories.other.empty', 'Une catégorie autre ne possède pas de titre. Veuillez en renseigner une.');

                        }
                        
                    }

                }

            });

        })->validate();

        // Enregistrement du projet
        $project = new Project;
        $project->name = $this->name;
        $project->description = $this->description;
        $project->summary = $this->summary;
        $project->code_name = $this->code_name;
        $project->user_id = Auth::id();
        $project->save();

        // Enregistrement de la categorisation
        foreach($this->categoriesSelected as $category){

            error_log($category["type"]);

            if($category["type"] == "other"){

                $otherCategory = new OtherCategory;
                $otherCategory->name = $category["name"];
                $otherCategory->slug = Str::slug($category["name"], '-');
                $otherCategory->type = "other";
                $otherCategory->save();

                $projectCategory = new ProjectCategory;
                $projectCategory->project_id = $project->id;
                $projectCategory->category_id = $otherCategory->id;
                $projectCategory->type = "other";
                $projectCategory->save();

            }else{

                $id = $category["id"];
                $projectCategory = new ProjectCategory;
                $projectCategory->project_id = $project->id;
                $projectCategory->category_id = $id;
                $projectCategory->type = "system";
                $projectCategory->save();

            }

        }
        
        // Notification
        session()->flash('flash.banner', 'Projet créé !');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route("project.show.bycodename",$project->code_name);
    }
    
    public function render()
    {
        return view('livewire.project.project-create-form');
    }
}
