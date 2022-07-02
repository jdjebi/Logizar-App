<x-app-layout>
    <x-slot name="extras_css">
        <style>
            .min-h-screen {
                background-color: #fff !important;
            }
        </style>
    </x-slot>

    @guest
        <x-slot name="header">
            <h2 class="text-2xl text-gray-800 font-bold">
                Bienvenue
            </h2>
            <div>Sans pression, partagez vos projets avec la Bizar Community !</div>
        </x-slot>
        <div class="mb-6"></div>
    @endguest

    <div class="px-4 my-2">
        <div class="grid grid-cols-1 md:grid-cols-6">
            <div class="mb-3 md:mb-0 ">
                @livewire('menus.categorization.categorization-sidebar')
            </div>
            <div class="col-span-5 md:ml-3">
                <div class="mb-2">
                    <span class="font-semibold text-lg">Récents</span>
                </div>

                <div>
                    @livewire('projects.project-simple-card-list')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
