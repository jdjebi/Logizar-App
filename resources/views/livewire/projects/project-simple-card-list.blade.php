<div class="columns-1 md:columns-3">
    @foreach ($projects as $project)
        @livewire('projects.project-simple-card',["project" => $project])
    @endforeach
</div>
