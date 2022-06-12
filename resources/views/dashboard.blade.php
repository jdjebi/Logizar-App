<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }} / Mes projets
        </h2>
    </x-slot>

    <div>
        <div class="bg-white border-t border-slate-200 py-1 px-5">
            @livewire('project-user-list-simple-box',["user" => Auth::user()])
        </div>
    </div>
</x-app-layout>
