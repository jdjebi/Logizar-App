@php
$categories = $project->categories();
@endphp

<div class="box-border break-inside-avoid">
    <div id="pj-{{ $project->id }}"
        class="break-inside-avoid p-4 mb-3 border box-border border-slate-400 rounded hover:border-blue-500 hover:shadow focus:ring-blue-300 active:ring-blue-300 transition">
        <a href="{{ !empty($project->code_name) ? route('project.show.bycodename', $project->code_name) : route('project.show.byid', $project->id) }}">
            <div class="text-xl font-semibold">{{ $project->name }}</div>
            <div class="mt-1">
                <span class="text-slate-500 text-sm">
                    {{ $project->user->name }} &middot; {{ $project->created_at->format('d/m/Y') }}
                </span>
            </div>
            <div class="mt-2 text-sm">
                {{ $project->summary ? Str::words($project->summary, 30) : Str::words($project->description, 30) }}
            </div>
            <div class="my-3">
                <x-project.category.category-liner :categories="$categories">
                    </x-project>
            </div>
            <div class="mt-3">
                <div class="text-right">
                    <x-buttons.light :href="!empty($project->code_name) ? route('project.show.bycodename', $project->code_name) : route('project.show.byid', $project->id)" class="text-xs px-2 py-1">Afficher</x-buttons.light>
                </div>
            </div>
        </a>
    </div>
</div>
