<?php

namespace App\Http\Livewire\Projects\Update;

use Livewire\Component;
use App\Models\Category;
use App\Models\OtherCategory;
use App\Models\ProjectCategory;
use Illuminate\Support\Str;

class ProjectUpdateCategorization extends Component
{
    public $project; 

    public $categories;
    public $categorySelectedId;
    public $categoriesTabou = [];
    public $categoriesSelected = [];

    public $otherCategoryContent;

    public $addCategoryDisabled = false;
    public $isFormEdited = false;

    protected $MAX_CATEGORY = 3;

    public $rules = [];

    public function mount(){
        // Il faudra gérer le cas des Autres catégories identiques de nom
        $this->categories = Category::orderBy("name")->get();
        $this->selectProjectCategories();   
        $this->checkAddingCategory();
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
            $this->checkAddingCategory();
            $this->toggleFormEdited();
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
        $this->toggleFormEdited();
    }

    public function toggleFormEdited(){
        if(!$this->isFormEdited){
            $this->isFormEdited = true;
        }else{
            $this->isFormEdited = false;   
        }
    }

    public function selectProjectCategories(){
        foreach($this->project->categories() as $c){
            $this->categoriesSelected[] = $c->toArray();
            if($c->type == "system"){
                $this->categoriesTabou[] = $c->id;
            }
        }
    }

    public function checkAddingCategory(){
        if(count($this->categoriesSelected) == $this->MAX_CATEGORY){
            $this->addCategoryDisabled = true;
        }else{
            $this->addCategoryDisabled = false;
        }
    }

    public function resetForm(){
        $this->reset("categorySelectedId");
        $this->reset("categoriesSelected");
        $this->reset("otherCategoryContent");
        $this->reset("categoriesTabou");
        $this->selectProjectCategories();
        $this->checkAddingCategory();
        $this->toggleFormEdited();
        $this->resetValidation();
    }

    public function submit(){
        /*
            Le modèle de mise à jour des catégories est à revoir. 
            Pour mettre à jour on supprimer toute les précédentes catégories puis on les récréés.
            Solutions: Persister les changements à chaque opération
        */


        /*
            Cette methode de validation permet de valider les categories car elles ne sont pas champs du composant.
            Leur validation est donc faite après la validation des champs. Ici on vérifie les axes suivant :

            - Verifier qu'il y'a au moins une categorie
            - Verification de la repetition d'une categorie
            - Verifier que les catégories existent (sauf celle autre)
            - Vérifier que la catégorie autre possède une description
            - Vérifier la taille du nom des catégories, y compris celle de la catégorie autre
        */

        $this->resetValidation();
                   
        if(count($this->categoriesSelected) == 0){
            $this->addError('categories.empty', 'Veuillez ajouter au moins une catégorie.');
            foreach($this->categoriesSelected as $category){
                if($category->type == "other" && !empty($category->name)){
                    $this->addError('categories.other.empty', 'Une catégorie autre ne possède pas de titre. Veuillez en ajouter une.');
                }
            }
        }

        $errors = $this->getErrorBag();

        if(count($errors) > 0){
            return;
        }

        // Suppression de la catégorisation précédente
        $projectCategories = $this->project->projectCategories()->get();
        foreach($projectCategories as $projectCategory){
            $projectCategory->delete();
        }

        // Enregistrement de la categorisation
        foreach($this->categoriesSelected as $category){

            if($category["type"] == "other"){

                $otherCategory = new OtherCategory;
                $otherCategory->name = $category["name"];
                $otherCategory->slug = Str::slug($category["name"], '-');
                $otherCategory->type = "other";
                $otherCategory->save();

                $projectCategory = new ProjectCategory;
                $projectCategory->project_id = $this->project->id;
                $projectCategory->category_id = $otherCategory->id;
                $projectCategory->type = "other";
                $projectCategory->save();

            }else{
                $id = $category["id"];
                $projectCategory = new ProjectCategory;
                $projectCategory->project_id = $this->project->id;
                $projectCategory->category_id = $id;
                $projectCategory->type = "system";
                $projectCategory->save();
            }

        }

        $this->selectProjectCategories();
        $this->resetForm();
        $this->isFormEdited = false;

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> "Catégories mises à jour !"
        ]);

    }

    public function render()
    {
        return view('livewire.projects.update.project-update-categorization');
    }
}
