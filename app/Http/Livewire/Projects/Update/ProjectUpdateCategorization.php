<?php

namespace App\Http\Livewire\Projects\Update;

use Livewire\Component;
use App\Models\OtherCategory;
use App\Models\ProjectCategory;
use Illuminate\Support\Str;
use App\Models\Tag;

class ProjectUpdateCategorization extends Component
{
    public $project;

    public $categories_selected = [];
    public $tags = [];

    public $is_form_edited = false;

    protected $listeners = [
        "tagsInputChanged" => "updateTags",
        "categoriesUpdated" => "updateCategories"
    ];

    public function mount()
    {
        $this->getProjectCategories();
        $this->getProjectTagsArray();
    }

    public function getProjectCategories()
    {
        if (!empty($this->categories_selected))
            $this->categories_selected = [];

        foreach ($this->project->categories() as $c) {
            $this->categories_selected[] = $c->toArray();
        }
    }

    public function getProjectTags()
    {
        return $this->project->tags;
    }

    public function getProjectTagsArray()
    {
        $tagsTmp = $this->getProjectTags()->toArray();
        $this->tags = array_map(function ($t) {
            return $t["name"];
        }, $tagsTmp);
    }

    public function resetForm()
    {
        $this->getProjectCategories();
        $this->getProjectTagsArray();
        $this->toggleFormEdited();
        $this->resetValidation();
        $this->emit('tagsRefreshed', [
            "data" =>  $this->tags
        ]);
        $this->emit('categoriesSelectedRefreshed', [
            "data" =>  $this->categories_selected
        ]);
    }

    public function toggleFormEdited()
    {
        if (!$this->is_form_edited) {
            $this->is_form_edited = true;
        } else {
            $this->is_form_edited = false;
        }
    }

    public function updateCategories($data)
    {
        $this->categories_selected = $data;
        $this->is_form_edited = true;
    }

    public function updateTags($tags)
    {
        $this->tags = $tags["data"];
        $this->is_form_edited = true;
    }


    public function submit()
    {
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

        if (count($this->categories_selected) == 0) {
            $this->addError('categories.empty', 'Veuillez ajouter au moins une catégorie.');
            foreach ($this->categories_selected as $category) {
                if ($category->type == "other" && !empty($category->name)) {
                    $this->addError('categories.other.empty', 'Une catégorie autre ne possède pas de titre. Veuillez en ajouter une.');
                }
            }
        }

        $errors = $this->getErrorBag();

        if (count($errors) > 0) {
            return;
        }

        // Suppression de la catégorisation précédente
        $projectCategories = $this->project->projectCategories()->get();
        foreach ($projectCategories as $projectCategory) {
            $projectCategory->delete();
        }

        // Enregistrement de la categorisation
        foreach ($this->categories_selected as $category) {
            if ($category["type"] == "other") {
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
            } else {
                $id = $category["id"];
                $projectCategory = new ProjectCategory;
                $projectCategory->project_id = $this->project->id;
                $projectCategory->category_id = $id;
                $projectCategory->type = "system";
                $projectCategory->save();
            }
        }

        // Suppression des tags précédents
        $tags = $this->getProjectTags();
        foreach ($tags as $tag) {
            $tag->delete();
        }

        // Enregistrement des nouveaus tags
        foreach ($this->tags as $t) {
            $tag = new Tag;
            $tag->name = $t;
            $tag->project_id = $this->project->id;
            $tag->save();
        }

        $this->resetForm();
        $this->is_form_edited = false;

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Catégories mises à jour !"
        ]);
    }

    public function render()
    {
        return view('livewire.projects.update.project-update-categorization');
    }
}
