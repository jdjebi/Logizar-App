<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-4 px-5">
            <h2 class="font-bold">Mes projets</h2>
        </div>
        <div class="bg-white border-gray-600 py-1 px-5">
            @livewire('project-user-list-simple-box',["user" => Auth::user()])
        </div>
    </div>
</x-app-layout>
