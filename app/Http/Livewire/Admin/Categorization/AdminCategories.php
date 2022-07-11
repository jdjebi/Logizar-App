<?php

namespace App\Http\Livewire\Admin\Categorization;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminCategories extends Component
{
    public $name;
    public $slug;
    public $categorySelected;

    public $search;

    public $uiOpenCreateModal = false;
    public $uiOpenUpdateModal = false;
    public $uiOpenDeleteModal = false;

    public $categories;

    public $rules = [
        "name" => "required|max:25|unique:categories"
    ];

    public function mount(){
        $this->categories = Category::orderByDesc("created_at")->get();
    }

    public function openCreateModal(){
        $this->resetValidation();
        $this->uiOpenCreateModal = true;
    }

    public function openUpdateModal(Category $category){     
        $this->categorySelected = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->resetValidation();
        $this->uiOpenUpdateModal = true;
    }

    public function openDeleteModal(Category $category){     
        $this->categorySelected = $category;
        $this->uiOpenDeleteModal = true;
    }

    public function create(){
        $this->validate();
        $category = new Category;
        $category->name = $this->name;
        $category->slug = Str::slug($this->name, '-');
        $category->save();
        $this->categories = Category::orderByDesc("created_at")->get();
        $this->uiOpenCreateModal = false;
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> "Catégorie ajoutée !"
        ]);
    }

    public function update(){
        $this->validate();
        $this->categorySelected->name = $this->name;
        $this->categorySelected->slug = Str::slug($this->name, '-');
        $this->categorySelected->save();
        $this->categories = Category::orderByDesc("created_at")->get();
        $this->uiOpenUpdateModal = false;
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> "Catégorie modifiée !"
        ]);
    }

    public function delete(){
        $this->categorySelected->delete();
        $this->categories = Category::orderByDesc("created_at")->get();
        $this->uiOpenDeleteModal = false;
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> "Catégorie supprimée !"
        ]);
    }

    public function render(){
        return view('livewire.admin.categorization.admin-categories');
    }
}
