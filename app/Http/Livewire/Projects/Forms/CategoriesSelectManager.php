<?php

namespace App\Http\Livewire\Projects\Forms;

use Livewire\Component;
use App\Models\Category;
use App\Models\OtherCategory;

class CategoriesSelectManager extends Component
{
    protected $MAX_CATEGORY = 3;

    public $categories;
    public $categories_tabou = [];
    public $categories_selected = [];
    public $category_selected_id;

    public $other_category;
    public $other_category_content;
    public $add_category_disabled = false;

    protected $listeners = [
        "categoriesSelectedRefreshed" => "updateCategoriesSelected",
    ];

    public function mount()
    {
        $this->categories = Category::orderBy("name")->get();
        $this->computeCategoryTabouList();
    }

    public function computeCategoryTabouList()
    {
        if (!empty($this->categories_tabou))
            $this->categories_tabou = [];

        $this->categories_tabou = array_map(function ($c) {
            return $c['id'];
        }, $this->categories_selected);
    }

    public function addCategory()
    {
        if (!empty($this->category_selected_id)) {
            if ($this->category_selected_id == "other" and !empty($this->other_category_content)) {
                $other_category = new OtherCategory;
                $other_category->name = $this->other_category_content;
                $other_category->type = "other";
                $this->categories_selected[] = $other_category->toArray();
            } else {
                $category = $this->categories->find($this->category_selected_id);
                $this->categories_selected[] = $category->toArray();
                $this->categories_tabou[] = $category->id;
            }
            if (count($this->categories_selected) == $this->MAX_CATEGORY) {
                $this->add_category_disabled = true;
            }
            $this->reset("category_selected_id");
            $this->reset("other_category_content");
            $this->emitCategoriesUpdated();
        }
    }

    public function removeCategory($key)
    {
        $tkey = array_search($this->categories_selected[$key]["id"], $this->categories_tabou);
        unset($this->categories_selected[$key]);
        if ($tkey) {
            unset($this->categories_tabou[$tkey]);
        }
        $this->categories_selected = array_values($this->categories_selected);
        $this->categories_tabou = array_values($this->categories_tabou);
        if (count($this->categories_selected) == $this->MAX_CATEGORY - 1) {
            $this->add_category_disabled = false;
        }
        $this->emitCategoriesUpdated();
    }

    public function emitCategoriesUpdated()
    {
        $this->emit("categoriesUpdated", $this->categories_selected);
    }

    public function updateCategoriesSelected($categories_selected)
    {
        $this->categories_selected = $categories_selected["data"];
        $this->computeCategoryTabouList();
    }

    public function render()
    {
        return view('livewire.projects.forms.categories-select-manager');
    }
}
