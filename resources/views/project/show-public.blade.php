<x-app-layout>

    <x-slot name="extras_css">
        <style>
            .min-h-screen {
                background-color: #fff !important;
            }
        </style>
    </x-slot>

    @auth
        @if (Auth::user()->id == $project->user->id)
            <x-project.viewform.plugins.alert-codename-missing :project="$project" />
        @endif
    @endauth

    @livewire('projects.project-view-form', ['project' => $project])

</x-app-layout>
