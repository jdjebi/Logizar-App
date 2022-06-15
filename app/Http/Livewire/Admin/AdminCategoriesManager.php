<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminCategoriesManager extends Component
{
    public $name;

    public $search;

    public $uiOpenCreateModal = false;

    public $categories;

    public $rules = [
        "name" => "required|max:30|unique:categories"
    ];

    public function mount(){
        $this->categories = Category::orderByDesc("created_at")->get();
    }

    public function openCreateModal(){
        $this->reset("name");
        $this->resetValidation();
        $this->uiOpenCreateModal = true;
    }

    public function submit(){
        $this->reset('search');
        $this->validate();

        $category = new Category;

        $category->name = $this->name;
        $category->slug = Str::slug($this->name, '-');
        $category->save();

        session()->flash('flash.banner', 'Catégorie ajoutée');
        session()->flash('flash.bannerStyle', 'success');

        $this->categories = Category::orderByDesc("created_at")->get();

        $this->uiOpenCreateModal = false;

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> "Catégorie ajoutée !"
        ]);

        // return redirect()->route("admin.index");

    }

    public function render()
    {
        return view('livewire.admin.admin-categories-manager');
    }
}
