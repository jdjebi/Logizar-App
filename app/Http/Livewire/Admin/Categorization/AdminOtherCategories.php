<?php

namespace App\Http\Livewire\Admin\Categorization;

use Livewire\Component;
use App\Models\OtherCategory;
use Illuminate\Support\Str;

class AdminOtherCategories extends Component
{
   
    public $categories;

    public function mount(){
        $this->categories = OtherCategory::orderByDesc("created_at")->get();
    }

    public function render()
    {
        return view('livewire.admin.categorization.admin-other-categories');
    }
}
