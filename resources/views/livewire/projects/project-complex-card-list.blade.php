@php
$nbrProjects = count($projects)
@endphp

@if($nbrProjects < 3)

    <div class="grid grid-cols-1 gap-0 md:grid-cols-2 lg:grid-cols-3 md:gap-3">
        @foreach ($projects as $project)
            @livewire('projects.project-complex-card',["project" => $project],key("2-".$project->id))
        @endforeach
    </div>

@else

    <div class="lg:columns-3 md:columns-2">
        @foreach ($projects as $project)
            @livewire('projects.project-complex-card',["project" => $project],key($project->id))
        @endforeach
    </div>

@endif