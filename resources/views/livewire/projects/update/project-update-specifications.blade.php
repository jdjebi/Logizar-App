<x-forms.edit-form submit="submit">

    <x-slot name="title">Spécifications</x-slot>

    <x-slot name="description">
        La spécification vous permet de préciser certaines caractéristique spécifique à votre
        projet. Elle permet de mieux caractériser votre projet par rapport aux autres et lui donne ainsi une meilleur
        visibilité dans les recherches spécifiques.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <div class="text-2xl font-semibold mb-4">Spécifications</div>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="type_id" value="Type de projet*" />
            <x-forms.select name="type_id" class="block mt-1" wire:model='type_id'>
                @foreach ($project_types as $types)
                    <option value="{{ $types->id }}">{{ $types->name }}</option>
                @endforeach
                <option value="other">Autre</option>
            </x-forms.select>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="deliverable_id" value="Livrable*" />
            <x-forms.select name="deliverable_id" class="block mt-1" wire:model='deliverable_id'>
                <option value="">Sélectionnez un livrable</option>
                @foreach ($project_deliverables as $deliverable)
                    <option value="{{ $deliverable->id }}">
                        {{ $deliverable->name }}</option>
                @endforeach
                <option value="other">Autre</option>
            </x-forms.select>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-forms.checkbox id="is_opensource" class="mb-4" model='is_opensource' message="Projet opensource" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>
