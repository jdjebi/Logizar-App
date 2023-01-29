<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class TagsInput extends Component
{
    public $tagsInput = null;

    public $tags = [];

    public $nbrCount = 0;

    const MAX_NBR_TAGS = 10;

    protected $listeners = [
        "tagsRefreshed" => "updateTagsFromEvent"
    ];

    public function mount()
    {
        $this->tagsInput = implode(", ", $this->tags);
    }

    public function tagsInputUpdate()
    {
        $content = trim($this->tagsInput);
        $tagsTmp = explode(",", $content);

        $this->nbrCount = count($tagsTmp);

        error_log($this->nbrCount);

        if($this->nbrCount <= TagsInput::MAX_NBR_TAGS){

            $tags = array_filter($tagsTmp, function ($t) {
                return !ctype_space($t) and !empty($t);
            });

            $tags = array_map(function ($t) {
                return trim(strtolower($t));
            }, $tags);

            $this->tags = $tags;
            
            $this->emit('tagsInputChanged', [
                "data" => $tags
            ]);
        
        }
    }

    public function updateTagsFromEvent($tags)
    {
        $this->tags = $tags["data"];
        $this->tagsInput = implode(", ", $this->tags);
    }

    public function render()
    {
        return view('livewire.forms.tags-input');
    }
}
