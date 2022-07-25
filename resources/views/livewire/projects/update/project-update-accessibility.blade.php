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
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-forms.inputs.label-input model="site_url" label="Site web" comment="100 caractères au maximum." class="w-full" />
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-forms.inputs.label-input model="repository_url" label="Lien du dépôt" comment="100 caractères au maximum." class="w-full"/>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>
