<x-forms.edit-form submit="submit">

    <x-slot name="title">Accéssibilité</x-slot>

    <x-slot name="description">
        Précisez les informations permettant de retrouver des informations plus complète sur
        votre projet. L'accéssibilité vous permet de mieux valoriser votre projet par la précision de canaux web par
        lesquels d'autres utilisateurs pourront découvrir vos travaux.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <div class="text-2xl font-semibold mb-4">Accéssibilité</div>
            <x-jet-label for="site_url" value="Site web" />
            <x-jet-input id="site_url" type="text" class="mt-1 block w-full" wire:model="site_url" />
            <span class="text-sm text-gray-500">100 caractères au maximum.</span>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="repository_url" value="Lien du dépôt" />
            <x-jet-input id="repository_url" type="text" class="mt-1 block w-full" wire:model="repository_url" />
            <span class="text-sm text-gray-500">100 caractères au maximum.</span>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>
