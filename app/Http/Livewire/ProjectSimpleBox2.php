<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProjectSimpleBox2 extends ProjectSimpleBox
{
    public $project;
    public $name;
    public $description;
    public $owner;
    public $created_at;
    public $project_id;

    public function render()
    {
        return view('livewire.project-simple-box2');
    }
}