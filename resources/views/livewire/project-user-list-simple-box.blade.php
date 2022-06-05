<div>
    @if(!$projects)
        <div class="text-center">
            <div class="font-semibold text-lg">
                <div>
                    Aucun projet pour l'instant ? Exprimez vos idées librement !
                </div>
                <div>
                    Exprimez vos idées librement ! Car l'expression est le pourquoi de l'existence de Logizar.
                </div>
            </div>
        </div>
    @else
        <div>
            @foreach ($projects as $project)
                <livewire:project-simple-box :project="$project">
                <hr>
            @endforeach
        </div>
    @endif
</div>
