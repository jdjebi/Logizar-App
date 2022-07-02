<div>
    @if(count($projects) == 0)
        <div class="text-center">
            <div class="font-semibold text-lg my-10">
                <div>
                    Aucun projet pour l'instant
                </div>
                <div class="mt-5">
                    Exprimez vos idées librement ! L'expression est le pourquoi de l'existence de Logizar
                </div>
                <div class="mt-5">
                    <x-buttons.default href="{{ route('project.create') }}" class="text-lg">Créer un projet</x-buttons.default>
                </div>
            </div>
        </div>
    @else
        <div>
            @foreach ($projects as $project)
                @livewire("project-simple-box", ["project" => $project], key($project->id))
                <hr>
            @endforeach
        </div>
    @endif
</div>
