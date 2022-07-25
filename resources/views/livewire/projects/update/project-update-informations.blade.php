<x-forms.edit-form submit="submit">

    <x-slot name="title">Description du projet</x-slot>

    <x-slot name="description">Décrivez textuellement les détails de votre projet. N'hésitez pas à vous exprimer, vous
        êtes libre !</x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <div class="text-2xl font-semibold mb-4">Description</div>
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-forms.inputs.label-input model="name" label="Nom du projet*" comment="30 caractères au maximum." class="w-full" wire:input="generateCodeName" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-project.forms.codename-input />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-forms.inputs.label-input model="summary" label="Résumé*" comment="70 caractères au maximum." class="w-full" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-forms.inputs.label-textarea model="description" label="Description*" cols="30" rows="10" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="status" value="Statut du projet*" />
            <x-forms.select name="status" class="block mt-1" wire:model="status">
                @foreach ($statusList as $status)
                    <option value="{{ $status["name"] }}">{{  $status["label"] }}</option>
                @endforeach
            </x-forms.select>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-button>Enregistrer</x-jet-button>
    </x-slot>

</x-forms.edit-form>
