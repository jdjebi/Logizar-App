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
            <div class="mt-4">
                <div class="text-lg mb-3">Catégories</div>
            </div>
            <div class="mb-2 text-sm pl-3">
                @foreach ($categoriesSelected as $category)
                    <div class="mb-1">
                        <a wire:click="removeCategory({{ $loop->index }})" href="javascript:void(0)"
                            class="active:focus:bg-red-300 inline-flex items-center p-1 mr-2 text-sm font-semibold text-red-800 bg-red-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                            </svg>
                        </a>
                        @if ($category['type'] == 'system')
                            <span>{{ $category['name'] }}</span>
                        @else
                            <span>Autre({{ $category['name'] }})</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <div>
                <div class="flex items-center">
                    <x-forms.select name="category" class="block mt-1" wire:model="categorySelectedId">
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach ($categories as $category)
                            @if (!in_array($category->id, $categoriesTabou))
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                        <option value="other">Autre</option>
                    </x-forms.select>
                    @if ($categorySelectedId == 'other')
                        <x-jet-input id="otherCategoryContent" class="block mt-1 w-full ml-3" type="text"
                            wire:model.defer="otherCategoryContent" placeholder="Titre de la catégorie" />
                    @endif
                </div>
                <div class="mt-5">
                    <x-jet-button type="button" class="py-2 px-2.5" wire:click="addCategory" :disabled="$addCategoryDisabled">Ajouter</x-jet-button>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-buttons.btn-light type="button" class="uppercase" wire:click='resetForm' :disabled="!$isFormEdited">Annuler</x-buttons.btn-light>
        &nbsp;
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>