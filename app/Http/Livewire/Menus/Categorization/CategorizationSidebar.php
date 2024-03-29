<?php

namespace App\Http\Livewire\Menus\Categorization;

use Livewire\Component;
use App\Models\Category;

class CategorizationSidebar extends Component
{

    public $categories;

    public $categoriesSelected = [];

    public function mount()
    {
        $this->categories = Category::orderBy("name")->get();
        foreach ($this->categories as $category) {
            $this->categoriesSelected[$category->id] = false;
        }
    }

    public function toggleCategorySelection($categoryId)
    {
        $this->categoriesSelected[$categoryId] = !$this->categoriesSelected[$categoryId];
        $this->getIdCategoriesSelected();
    }

    public function getIdCategoriesSelected()
    {
        $keys = array_keys($this->categoriesSelected, true);
        $this->emit('projectsSelectedByCategorizationSidebar', [
            "keys" => $keys,
        ]);
    }

    public function render()
    {
        return view('livewire.menus.categorization.categorization-sidebar');
    }
}
