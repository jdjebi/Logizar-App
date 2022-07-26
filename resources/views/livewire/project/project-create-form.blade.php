<div class="bg-white border-inherit p-5">

    <x-jet-validation-errors class="mb-4" />

    <form wire:submit.prevent="submit" autocomplete="off">

        <div id="description">

            <div class="text-xl">Description du projet</div>

            <div class="border-b my-3"></div>

            <div>
                <x-forms.inputs.label-input model="name" label="Nom du projet*" comment="30 caractères au maximum." class="w-full" wire:input="generateCodeName"/>
            </div>

            <div class="mt-4">
               <x-project.forms.codename-input />
            </div>

            <div class="mt-4">
                <x-forms.inputs.label-input model="summary" label="Résumé*" comment="70 caractères au maximum." class="w-full"/>
            </div>

            <div class="mt-4">
                <x-forms.inputs.label-textarea model="description" label="Description*" cols="30" rows="10"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="status" value="Statut du projet*" />
                <x-forms.select name="status" class="block mt-1" wire:model="status">
                    @foreach ($projectStatusList as $status)
                        <option value="{{ $status['name'] }}">{{ $status['label'] }}</option>
                    @endforeach
                </x-forms.select>
            </div>

        </div>

        <div id="categorize" class="mt-5">

            <div class="text-xl">Catégorisation</div>

            <div class="border-b my-3"></div>

            <div>
                <div class="mb-2">
                    <x-jet-label for="category" value="Catégories du projet*" />
                </div>
    
                @livewire('projects.forms.categories-select-manager')
            </div>

            <div class="mt-5">
                <x-jet-label for="tagsInput" value="Tags" />
                <div class="mt-1">
                    @livewire('forms.tags-input')
                </div>
            </div>

        </div>

        <div id="specification" class="mt-5">
            <div class="text-xl">Spécifications</div>
            <div class="border-b my-3"></div>
            <div>
                <div class="mt-4">
                    <x-jet-label for="type_id" value="Type de projet*" />
                    <x-forms.select name="type_id" class="block mt-1" wire:model='type_id'>
                        @foreach ($projectTypes as $types)
                            <option value="{{ $types->id }}">
                                {{ empty($types->shortname) ? $types->name : $types->shortname }}</option>
                        @endforeach
                        <option value="other">Autre</option>
                    </x-forms.select>
                </div>
                <div class="mt-4">
                    <x-jet-label for="deliverable_id" value="Livrable*" />
                    <x-forms.select name="deliverable_id" class="block mt-1" wire:model='deliverable_id'>
                        <option value="">Sélectionnez un livrable</option>
                        @foreach ($projectDeliverables as $deliverable)
                            <option value="{{ $deliverable->id }}">
                                {{ $deliverable->name }}
                            </option>
                        @endforeach
                        <option value="other">Autre</option>
                    </x-forms.select>
                </div>
                <div class="mt-4">
                    <x-forms.checkbox id="is_opensource" class="mb-4" model='is_opensource' :value="old('is_opensource')"
                        message="Projet opensource" />
                </div>
            </div>
        </div>

        <div id="accessibility" class="mt-5">
            <div class="text-xl">Accessibilité</div>
            <div class="border-b my-3"></div>
            <div>
                <div>
                    <x-forms.inputs.label-input model="site_url" label="Site web" comment="100 caractères au maximum." class="w-full" />
                </div>
                <div class="mt-4">
                    <x-forms.inputs.label-input model="repository_url" label="Lien du dépôt" comment="100 caractères au maximum." class="w-full"/>
                </div>
            </div>
        </div>

        <div class="border-b my-3"></div>

        <div class="mt-4 text-right">
            <x-jet-button type="submit">Enregistrer</x-jet-button>
        </div>

    </form>

</div>
