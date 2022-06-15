<x-app-layout>
    <x-slot name="extras_css">
        <style>
            .min-h-screen{
                background-color: #fff !important;
            }
        </style>
    </x-slot>

    <x-slot name="header">
        <h2 class="text-2xl text-gray-800 font-bold">
            {{ __('Projets') }}
        </h2>
        <div>Sans pression, partagez vos projets avec la Bizar Community !</div>
    </x-slot>

    <div class="container p-4">
        @livewire('projects.project-simple-card-list')
    </div>
    
</x-app-layout>
