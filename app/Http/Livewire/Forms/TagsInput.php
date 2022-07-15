<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class TagsInput extends Component
{
    public $tagsInput;

    public $tags = [];

    public function tagsInputUpdate(){

        $content = trim($this->tagsInput);

        $tagsTmp = explode(",",$content);

        $tags = array_filter($tagsTmp,function ($t){
            return !ctype_space($t) and !empty($t);
        });

        $tags = array_map(function ($t){
            return strtolower($t);
        },$tags);

        $this->tags = $tags;

        $this->emit('tagsInputChanged',[
            "data" => $tags
        ]);
    }

    public function render()
    {
        return view('livewire.forms.tags-input');
    }
}
