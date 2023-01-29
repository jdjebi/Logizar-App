@php
$categories = $project->categories();
@endphp

<div class="box-border break-inside-avoid">
    <div id="pj-{{ $project->id }}"
        class="break-inside-avoid p-3 mb-3 border box-border border-slate-400 rounded hover:border-blue-500 hover:shadow focus:ring-blue-300 active:ring-blue-300 transition">
        <a
            href="{{ !empty($project->code_name) ? $project->url : route('project.show.byid', $project->id) }}">
            <div class="flex">
                <div>
                    <div class="project-logo project-logo-60 mr-2">
                        <img src="{{ asset('imgs/projects/package.png') }}" alt="Logo projet {{ $project->name }}">
                    </div>
                </div>
                <div class="grow pt-1">
                    <div class="flex justify-between">
                        <div class="xl:w-52 lg:w-36 md:w-44 w-60">
                            <div class="truncate" title="{{ $project->name }}">{{ $project->name }}</div>
                            <div class="truncate mt-1 text-slate-500  text-xs" title="{{ $project->type ? $project->type->name : '' }}">
                                {{ $project->user->name }} | {!! $project->type ? ($project->type->shortname ? $project->type->shortname : $project->type->name) : 'Projet' !!}
                            </div>
                        </div>
                        <div class="pt-2 flex justify-end">
                            @if ($project->is_opensource)
                                <i class="fa-brands fa-osi text-xs font-bold cursor-pointer mr-1" title="Projet opensource"></i>
                            @endif
                            <x-dots.status-dot :project="$project" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-sm break-words">
                {{ $project->summary ? Str::words($project->summary, 30) : Str::words($project->description, 30) }}
            </div>
            <div class="my-3">
                <x-project.category.category-liner :categories="$categories"/>
            </div>
        </a>
    </div>
</div>
