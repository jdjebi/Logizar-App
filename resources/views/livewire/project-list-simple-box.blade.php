<div>
    @foreach ($projects as $project)
        <livewire:project-simple-box :project="$project">
        <hr>
    @endforeach
</div>