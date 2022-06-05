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
        @livewire('project-list-simple-box')
    </div>
    <footer>
        <div class="p-2">
            <span class="text-sm">Par Jean-Marc Dje Bi</span>
        </div>
    </footer>
</x-app-layout>
