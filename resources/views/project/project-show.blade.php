<x-app-layout>

    <x-slot name="extras_css">
        <style>
            .min-h-screen{
                background-color: #fff !important;
            }
        </style>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }} / <a href="{{ route("dashboard") }}" class="text-blue-500">Mes projets</a> / {{ $project->name }}
        </h2>
    </x-slot>

    @auth
        @if (Auth::user()->id == $project->user->id)
            <x-project.viewform.plugins.alert-codename-missing :project="$project" />
        @endif
    @endauth

    @livewire('projects.project-view-form', ["project" => $project])

</x-app-layout>
