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

    <footer class="container flex justify-between mt-3">
        <div class="p-2">
            <div class="mb-3 text-lg">Contact</div>
            <div class="text-sm">
                <div>Contact : (+225) 01 53 52 59 65</div>
                <div>E-mail : jeanmarcdjebi@gmail.com</div>
            </div>
        </div>
        <div class="p-2">
            <div class="mb-3 text-lg">A propos</div>
            <div class="text-sm">
                <div>Par Jean-Marc Dje Bi</div>
                <div>version 0.0.1</div>
            </div>
        </div>
    </footer>
    
</x-app-layout>
