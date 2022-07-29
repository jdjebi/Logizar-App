<div>

    <div class="p-4">
        <div class="text-xl font-semibold flex items-center">

            <span>
                {{ $name }}
            </span>

            @empty($project->code_name)
                <span class="ml-2" title="Problème détecté. Affichez pour constater">
                    <svg class="flex-shrink-0 w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            @endempty
        </div>
        <div class="text-slate-500 text-sm">{{ $owner->name }} &middot; {{ $created_at }}</div>
        <div class="mt-3">
            <span class="text-sm">
                {{ $project->summary ? $project->summary : 'Aucun résumé' }}
            </span>
        </div>
        <div class="mt-2">
            {{ Str::words($project->description, 40) }}
        </div>
        <div class="mt-2">
            <x-project.category.category-liner :categories="$project->categories()">
                </x-project>
        </div>
        <div class="mt-4">
            <x-buttons.light :href="route('project.show.byid', $project_id)" class="text-xs">Afficher</x-buttons.light>

            <x-buttons.default :href="route('project.update', $project_id)" class="text-xs">Modifier</x-buttons.default>

        </div>
    </div>

    <hr>

</div>
