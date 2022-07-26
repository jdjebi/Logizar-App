<x-forms.edit-form submit="submit">

    <x-slot name="title">Catégorisation du projet</x-slot>

    <x-slot name="description">
        Permet de préciser en peu de mots ses domaines d'intervention et d'autres spécificités.
        Elle le démarque des autres et facilite son identification dans la recherche de projets similaires. Ainsi, bien
        catégoriser son projet, c'est le rendre plus visibilité et mieux valoriser.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <div class="text-2xl font-semibold">Catégorisation</div>
        </div>
        <div class="col-span-6 sm:col-span-4">

            <div>
                <div class="mb-2">
                    <x-jet-label for="category" value="Catégories du projet*" />
                </div>
                @livewire('projects.forms.categories-select-manager', ['categories_selected' => $categories_selected])
            </div>

            <div class="mt-7">
                <div class="mb-2">
                    <x-jet-label for="category" value="Tags" />
                </div>
                <div class="mt-1">
                    @livewire('forms.tags-input',[
                        "tags" => $tags
                    ])
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-buttons.btn-light type="button" class="uppercase" wire:click='resetForm' :disabled="!$is_form_edited">Annuler</x-buttons.btn-light>
        &nbsp;
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>