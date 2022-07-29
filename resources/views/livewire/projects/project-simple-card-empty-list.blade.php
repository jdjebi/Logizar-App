@php
$nbr_projects = count($projects);
@endphp


<div>

    @if($show_counter)
        <div class="mb-2">
            <span class="font-semibold text-lg">{{ $nbr_projects }} @choice('Résultat|Résultats', $nbr_projects)</span>
        </div>
    @endif

    @if ($nbr_projects < 3)

        <div class="grid grid-cols-1 gap-0 md:grid-cols-2 lg:grid-cols-3 md:gap-3">
            @foreach ($projects as $project)
                @livewire('projects.project-complex-card', ['project' => $project], key($project->id))
            @endforeach
        </div>
    @else
        <div class="columns-3xs">
            @foreach ($projects as $project)
                @livewire('projects.project-complex-card', ['project' => $project], key($project->id))
            @endforeach
        </div>

    @endif

</div>
