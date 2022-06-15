<div>

    <div class="p-4">
        <div class="text-xl font-semibold ">{{ $name }}</div>
        <div class="text-slate-500 text-sm">{{ $owner->name }} &middot; {{ $created_at }}</div>
        <div class="mt-3">
            <span class="text-sm">
                {{ $project->summary ? $project->summary : "Aucun résumé" }}
            </span>
        </div>
        <div class="mt-2">
            {{ Str::words($project->description , 40) }}
        </div>
        <div class="mt-4">
            <x-buttons.light :href="route('project.show',$project_id)" class="text-xs">Afficher</x-buttons.light>

            <x-buttons.default :href="route('project.update',$project_id)" class="text-xs">Modifier</x-buttons.default>

            <x-buttons.red wire:click="openConfirmDeletionModal" href="#delete" class="text-xs">Supprimer</x-buttons.red>
        </div>
    </div>
    
    <hr>

    <x-jet-confirmation-modal wire:model="uiConfirmingUserDeletion" maxWidth="md">
        <x-slot name="title">
            Supprimer projet
        </x-slot>
        <x-slot name="content">
            Voulez-vous vraiment supprimer le projet ?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('uiConfirmingUserDeletion')" wire:loading.attr="disabled">
                Annuler
            </x-jet-secondary-button>
    
            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                Supprimer le projet
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>