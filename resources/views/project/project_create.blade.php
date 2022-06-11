<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau projet') }}
        </h2>
    </x-slot>

    <div class="container p-8 flex justify-between">
        <div class="grow-0 mr-8">
            <div>
                <span class="text-2xl font-bold">Alors,<br><br>A quoi vous avez pensé ?</span>
            </div>
        </div>
        <div class="grow">
            
            <livewire:project-create-form />
    
        </div>
    </div>

</x-app-layout>