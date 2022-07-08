<x-forms.edit-form submit="submit">

    <x-slot name="title">Description du projet</x-slot>

    <x-slot name="description">Décrivez textuellement les détails de votre projet. N'hésitez pas à vous exprimer, vous
        êtes libre !</x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <div class="text-2xl font-semibold mb-4">Description</div>
            <x-jet-label for="name" value="{{ __('Nom') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                wire:input="generateCodeName" />
            <span class="text-sm text-gray-500">le résumé doit posséder 30 caractères</span>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="summary" value="{{ __('Résumé') }}" />
            <x-jet-input id="summary" type="text" class="mt-1 block w-full" wire:model="summary" />
            <span class="text-sm text-gray-500">le résumé doit posséder 70 caractères</span>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="code_name" value="Code du projet" title="Nom du projet utilisé dans son url" />
            <x-jet-input id="code_name" class="block mt-1 w-full" type="text" wire:model="code_name"
                wire:input='checkCodeNameUnicity' :value="old('code_name')" />
            <div class="my-3">
                <span
                    class="text-xs text-gray-500 {{ empty($code_name) || $codeNameIsUnique ? '' : 'text-red-600' }}">
                    Lien du projet : {{ $this->baseUrl }}/{{ $this->code_name }}
                    @if (!empty($code_name) && !$codeNameIsUnique)
                        , code déjà utilisé.
                    @endif
                </span>
            </div>

            <span class="text-sm text-gray-500">45 caractères au maximum. Le code du projet est unique.
                Appliquez de petites variations pour le rendre unique si necessaire. Exemple : <span
                    class="font-semibold">logizar.app ou logizar.1</span>. Les caractères spéciaux autorisés : "- .".
                Mais ces derniers ne doivent figurés ni au début ni à la fin du code.
            </span>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="Description" />
            <textarea
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                wire:model="description" cols="30" rows="10"></textarea>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>
