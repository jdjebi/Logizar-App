<div>
    <x-buttons.btn-red wire:click='openConfirmDeletionModal' href="#delete">Supprimer</x-buttons.btn-red>

    <x-jet-confirmation-modal wire:model="ui_confirming_user_deletion" maxWidth="md">
        <x-slot name="title">
            Supprimer projet
        </x-slot>
        <x-slot name="content">
            Voulez-vous vraiment supprimer le projet ?
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('ui_confirming_user_deletion')" wire:loading.attr="disabled">
                Annuler
            </x-jet-secondary-button>
    
            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                Supprimer le projet
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
