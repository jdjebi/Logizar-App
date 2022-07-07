<div class="bg-white border-inherit p-5">

    <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="submit" autocomplete="off">
        @csrf

        <div id="description">

            <div class="text-xl">Description du projet</div>

            <div class="border-b my-3"></div>

            <div>
                <x-jet-label for="name" value="Nom du projet" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                    wire:input="generateCodeName" :value="old('name')" />
                <span class="text-sm text-gray-500">30 caractères au maximum.</span>
            </div>

            <div class="mt-4">
                <x-jet-label for="code_name" value="Code du projet" title="Nom du projet utilisé dans son url" />
                <x-jet-input id="code_name" class="block mt-1 w-full" type="text" wire:model="code_name"
                    wire:input='checkCodeNameUnicity'
                    :value="old('code_name')" />
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
                        class="font-semibold">logizar.app ou logizar.1</span>. Les caractères spéciaux autorisés : "- .". Mais ces derniers ne doivent figurés ni au début ni à la fin du code.
                </span>
            </div>

            <div class="mt-4">
                <x-jet-label for="summary" value="Résumé" />
                <x-jet-input id="summary" class="block mt-1 w-full" type="text" wire:model="summary"
                    :value="old('summary')" />
                <span class="text-sm text-gray-500">70 caractères au maximum.</span>
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="Description" />
                <textarea
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                    wire:model="description" id="" cols="30" rows="10"></textarea>
            </div>

        </div>

        <div id="categorize" class="mt-5">

            <div class="text-xl">Catégorisation</div>
            <div class="border-b my-3"></div>
            <div>

                <div>
                    <x-jet-label for="categorie" value="Catégories du projet" />
                </div>

                <div class="flex items-center mt-2">

                    <x-forms.select name="category" class="block mt-1" wire:model="categorySelectedId">
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach ($categories as $category)
                            @if (!in_array($category->id, $categoriesTabou))
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                        <option value="other">Autre</option>
                        </x-forms>

                        @if ($categorySelectedId == 'other')
                            <x-jet-input id="otherCategoryContent" class="block mt-1 w-full ml-3" type="text"
                                wire:model.defer="otherCategoryContent" placeholder="Titre de la catégorie" />
                        @endif

                        <div class="ml-3">
                            <x-jet-button type="button" class="py-3" wire:click="addCategory" :disabled="$addCategoryDisabled">
                                Ajouter</x-jet-button>
                        </div>

                </div>

                <div class="mt-2">
                    @foreach ($categoriesSelected as $category)
                        @if ($category['type'] == 'system')
                            <div class="flex items-center mb-2">
                                <div>
                                    <x-jet-input name="category-{{ $loop->index }}" type="text"
                                        value="{{ $category['name'] }}" class="block mt-1 disabled:bg-gray-100"
                                        disabled>
                                        </x-input>
                                </div>
                                <div class="ml-3">
                                    <x-buttons.btn-red type="button" class="py-3 uppercase"
                                        wire:click="removeCategory({{ $loop->index }})">Retirer</x-jet-button>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center mb-2">
                                <div>
                                    <x-jet-input type="text" value="Autre ({{ $category['name'] }})"
                                        class="block mt-1 disabled:bg-gray-100" disabled>
                                        </x-input>
                                </div>
                                <div class="ml-3">
                                    <x-buttons.btn-red type="button" class="py-3 uppercase"
                                        wire:click="removeCategory({{ $loop->index }})">Retirer</x-jet-button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>

        <div class="border-b my-3"></div>

        <div class="mt-4 text-right">
            <x-jet-button>Enregistrer</x-jet-button>
        </div>

    </form>

</div>
