<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }} / <a href="{{ route("dashboard") }}" class="text-blue-500">Mes projets</a> / <a href="{{ route("project.show",$project->id) }}" class="text-blue-500"> {{ $project->name }} </a> / Modifier
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class="mt-10 sm:mt-0">
            @livewire('projects.update.project-update-informations',["project" => $project ])
        </div>

        <x-jet-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('projects.update.project-update-categorization',["project" => $project ])
        </div>

    </div>

</x-app-layout>
