<div class="bg-white border-inherit p-5">

    <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="submit">
        @csrf

        <div>
            <x-jet-label for="name" value="Nom du projet" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name')" />
            <span class="text-sm text-gray-500">le nom doit posséder 30 caractères</span>
        </div>

        <div class="mt-4">
            <x-jet-label for="summary" value="Résumé" />
            <x-jet-input id="summary" class="block mt-1 w-full" type="text" wire:model="summary" :value="old('summary')" />
            <span class="text-sm text-gray-500">le résumé doit posseder 70 caractères</span>
        </div>

        <div class="mt-4">
            <x-jet-label for="description" value="Description" />
            <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" wire:model="description" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="mt-4">  
            <x-jet-button>Enregistrer</x-jet-button>
        </div>

    </form>

</div>