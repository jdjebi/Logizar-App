<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class TagsInput extends Component
{
    public $tagsInput = null;

    public $tags = [];

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
