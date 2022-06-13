<x-app-layout>

    <x-slot name="extras_css">
        <style>
            .min-h-screen{
                background-color: #fff !important;
            }
        </style>
    </x-slot>

    @livewire('projects.project-view-form', ["project" => $project])

</x-app-layout>
