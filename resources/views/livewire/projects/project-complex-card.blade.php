@php
$categories = $project->categories();
@endphp

<div class="box-border break-inside-avoid">
    <div id="pj-{{ $project->id }}"
        class="break-inside-avoid p-4 mb-3 border box-border border-slate-400 rounded hover:border-blue-500 hover:shadow focus:ring-blue-300 active:ring-blue-300 transition">
        <a href="{{ !empty($project->code_name) ? route('project.show.bycodename', $project->code_name) : route('project.show.public', $project->id) }}">
            <div class="text-xl font-semibold">{{ $project->name }}</div>
            <div class="mt-1">
                <span class="text-slate-500 text-xs">
                    {{ $project->user->name }} | {!! $project->type ? ($project->type->shortname ? $project->type->shortname : $project->type->name )." &middot;" : "" !!} {!! $project->deliverable ? $project->deliverable->name : "Projet" !!} 
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
                <div class="text-right text-xs uppercase">
                    {{  $project->status ? $project->statusFull()['label'] : "Aucun statut"  }}
                </div>
            </div>
        </a>
    </div>
</div>
