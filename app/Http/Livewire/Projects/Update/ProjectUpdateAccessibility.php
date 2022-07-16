<?php

namespace App\Http\Livewire\Projects\Update;

use Livewire\Component;

class ProjectUpdateAccessibility extends Component
{
    public $project;

    public $site_url;
    public $repository_url;

    protected $rules = [
        'site_url' => 'nullable|url',
        'repository_url' => 'nullable|url',
    ];

    public function mount()
    {
        $this->site_url = $this->project->site_url;
        $this->repository_url = $this->project->repository_url;
    }

    public function submit()
    {
        $this->validate();

        $this->project->site_url = $this->site_url;
        $this->project->repository_url = $this->repository_url;
        $this->project->save();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Accéssibilité mise à jour !"
        ]);
    }

    public function render()
    {
        return view('livewire.projects.update.project-update-accessibility');
    }
}
