<x-forms.edit-form submit="submit">

    <x-slot name="title">Description du projet</x-slot>

    <x-slot name="description">Décrivez textuellement les détails de votre projet. N'hésitez pas à vous exprimer, vous êtes libre !</x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <div class="text-2xl font-semibold mb-4">Description</div>
            <x-jet-label for="name" value="{{ __('Nom') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name"/>
            <span class="text-sm text-gray-500">le résumé doit posséder 30 caractères</span>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="summary" value="{{ __('Résumé') }}" />
            <x-jet-input id="summary" type="text" class="mt-1 block w-full" wire:model="summary"/>
            <span class="text-sm text-gray-500">le résumé doit posséder 70 caractères</span>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="Description" />
            <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" wire:model="description" cols="30" rows="10"></textarea>                
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>