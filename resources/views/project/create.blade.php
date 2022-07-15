<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau projet') }}
        </h2>
    </x-slot>

    <div class="container p-8 flex flex-col md:flex-row justify-between">
        <div class="grow">
            
            <livewire:project-create-form />
    
        </div>
    </div>

</x-app-layout>