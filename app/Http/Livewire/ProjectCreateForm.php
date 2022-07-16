<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Category;
use App\Models\OtherCategory;
use App\Models\ProjectCategory;
use App\Models\ProjectType;
use App\Models\ProjectDeliverable;
use App\Models\Tag;
use App\Logizar\Project\ProjectStatusList;

use Illuminate\Validation\Validator;
use Illuminate\Support\Str;

class ProjectCreateForm extends Component
{
    public $categories;

    public $name;
    public $description;
    public $summary;
    public $code_name;
    public $status;
    public $type_id;
    public $deliverable_id;
    public $is_opensource = false;
    public $site_url;
    public $repository_url;
    public $tags;

    public $baseUrl;
    public $codeNameIsUnique = true;

    public $categorySelectedId;
    public $otherCategoryContent;
    public $categoriesSelected = [];
    public $categoriesTabou = [];
    public $addCategoryDisabled = false;
    protected $MAX_CATEGORY = 3;

    public $projectTypes = [];
    public $projectTypesList = [];
    public $projectDeliverables = [];

    protected $rules = [
        'name' => 'required|max:30',
        'code_name' => 'required|regex:/^\w[-.\w]*\w$/|max:45|unique:projects',
        'summary' => 'required|max:70',
        'description' => 'required',
        'type_id' => 'required',
        'deliverable_id' => 'required',
        'site_url' => 'nullable|url',
        'repository_url' => 'nullable|url',
        'is_opensource' => 'boolean'
    ];

    protected $listeners = [
        "tagsInputChanged" => "updateTags"
    ];

    public function mount()
    {

        $this->baseUrl = route("project.show.bycodename", [
            "code_name" => ""
        ]);

        $this->categories = Category::orderBy("name")->get();
        $this->projectTypes = ProjectType::orderBy("name")->get();
        $this->projectDeliverables = ProjectDeliverable::orderBy("name")->get();
        $this->projectStatusList = ProjectStatusList::STATUS_LIST;

        if (!empty($this->projectTypes)) {
            $this->type_id = $this->projectTypes[0]->id;
        }

        if (!empty($this->projectStatusList)) {
            $this->status = $this->projectStatusList["in_progress"]["name"];
        }
    }

    public function addCategory()
    {

        if (!empty($this->categorySelectedId)) {

            if ($this->categorySelectedId == "other") {
                if (!empty($this->otherCategoryContent)) {
                    $otherCategory = new OtherCategory;
                    $otherCategory->id = null;
                    $otherCategory->name = $this->otherCategoryContent;
                    $otherCategory->type = "other";
                    $this->categoriesSelected[] = $otherCategory->toArray();
                }
            } else {
                $category = $this->categories->find($this->categorySelectedId);
                $this->categoriesSelected[] = $category->toArray();
                $this->categoriesTabou[] = $category->id;
            }

            if (count($this->categoriesSelected) == $this->MAX_CATEGORY) {
                $this->addCategoryDisabled = true;
            }

            $this->reset("categorySelectedId");
            $this->reset("otherCategoryContent");
        }
    }

    public function updateTags($tags)
    {
        $this->tags = $tags["data"];
    }

    public function removeCategory($key)
    {
        $tkey = array_search($this->categoriesSelected[$key]["id"], $this->categoriesTabou);

        unset($this->categoriesSelected[$key]);

        if ($tkey) {
            unset($this->categoriesTabou[$tkey]);
        }

        $this->categoriesSelected = array_values($this->categoriesSelected);
        $this->categoriesTabou = array_values($this->categoriesTabou);

        if (count($this->categoriesSelected) == 2) {
            $this->addCategoryDisabled = false;
        }
    }

    public function generateCodeName()
    {
        if (empty($this->name)) {
            $this->code_name = "";
        } else {
            $this->code_name = Str::slug($this->name, ".");
        }
        $this->checkCodeNameUnicity();
    }

    public function checkCodeNameUnicity()
    {
        // Verifier si le code est unique
        $result = Project::where("code_name", $this->code_name)->count();
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

                if (count($this->categoriesSelected) == 0) {

                    $validator->errors()->add('categories.empty', 'Veuillez renseigner au moins une catégorie.');

                    foreach ($this->categoriesSelected as $category) {

                        if ($category->type == "other" && !empty($category->name)) {

                            $validator->errors()->add('categories.other.empty', 'Une catégorie autre ne possède pas de titre. Veuillez en renseigner une.');
                        }
                    }
                }

                if (count($validator->errors()) > 0) {
                    $this->dispatchBrowserEvent('alert', [
                        'type' => 'error',
                        'message' => "Le formulaire comporte des erreurs"
                    ]);
                }
            });
        })->validate();

        // Preparation de l'enregistrement
        if ($this->type_id == "other") {
            $this->type_id = null;
        }

        if ($this->deliverable_id == "other") {
            $this->deliverable_id = null;
        }

        // Enregistrement du projet
        $project = new Project;
        $project->name = $this->name;
        $project->description = $this->description;
        $project->summary = $this->summary;
        $project->code_name = $this->code_name;
        $project->user_id = Auth::id();
        $project->status = $this->status;
        $project->is_opensource = $this->is_opensource;
        $project->type_id = $this->type_id;
        $project->deliverable_id = $this->deliverable_id;
        $project->site_url = $this->site_url;
        $project->repository_url = $this->repository_url;
        $project->save();

        // Enregistrement de la categorisation
        foreach($this->categoriesSelected as $category){

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

        // Enregistrement des tags
        foreach($this->tags as $t){
            $tag = new Tag;
            $tag->name = $t;
            $tag->project_id = $project->id;
            $tag->save();
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
