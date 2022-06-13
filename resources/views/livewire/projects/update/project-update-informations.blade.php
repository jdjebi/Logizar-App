<x-forms.edit-form submit="submit">

    <x-slot name="title">Description du projet</x-slot>

    <x-slot name="description">Décrivez textuellement les détails de votre projet. N'hésitez pas à vous exprimer, vous êtes libre !</x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nom') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name"/>
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