<div>

    <div class="flex justify-between items-center flex-wrap mb-4 sm:mb-1">
        <div class="flex justify-between items-center">
            <div class="p-4">
                <h6 class="font-semibold">Livrables</h6>
            </div>
        </div>
        <div class="pl-4">
            <x-buttons.default wire:click='openCreateModal' href="javascript:void(0)">Ajouter</x-buttons>
        </div>
    </div>

    <div>
        <x-tables.simple-table.table tbodyStyle="odd:bg-white even:bg-gray-50">
            <x-slot name="columns">
                <x-tables.simple-table.th>#</x-tables.simple-table.th>
                <x-tables.simple-table.th>Nom</x-tables.simple-table.th>
                <x-tables.simple-table.th>Nom court</x-tables.simple-table.th>
                <x-tables.simple-table.th>Description</x-tables.simple-table.th>
                <x-tables.simple-table.th class="text-right">Actions</x-tables.simple-table.th>
            </x-slot>
            <x-slot name="rows">
                @foreach ($deliverables as $deliverable)  
                    <x-tables.simple-table.row class="odd:bg-white even:bg-gray-50">
                        <x-tables.simple-table.td class="font-medium text-gray-900 whitespace-nowrap">{{ $loop->index + 1 }}</x-tables.simple-table.td>
                        <x-tables.simple-table.td class="font-medium text-gray-900">{{ $deliverable->name }}</x-tables.simple-table.td>
                        <x-tables.simple-table.td>{{ $deliverable->shortname }}</x-tables.simple-table.td>
                        <x-tables.simple-table.td>{{ $deliverable->description }}</x-tables.simple-table.td>
                        <x-tables.simple-table.td class="text-right">
                            <x-buttons.light wire:click='openUpdateModal({{ $deliverable->id }})' href="javascript:void(0)" class="text-xs">Modifier</x-buttons>
                            <x-buttons.red wire:click='openDeleteModal({{ $deliverable->id }})' href="javascript:void(0)" class="text-xs mr-0">Supprimer</x-buttons>
                        </x-tables.simple-table.td>
                    </x-tables.simple-table.row>
                @endforeach
            </x-slot>
        </x-tables.simple-table.table>
    </div>

    <x-jet-modal wire:model="uiOpenCreateModal" maxWidth="md">
        <div class="relative bg-white rounded-lg shadow ">
            <button wire:click="$toggle('uiOpenCreateModal')" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-toggle="authentication-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900">Nouveau livrable</h3>
                <div>
                    <x-jet-validation-errors class="mb-1" />
                </div>
                <form class="space-y-6" wire:submit.prevent="create">
                    @csrf
                    <div>
                        <x-jet-label for="name" value="Nom du livrable" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" placeholder=""
                            wire:model="name" />
                        <small class="text-xs text-gray-500">30 caractères maximum</small>
                    </div>
                    <div class="mt-2">
                        <x-jet-label for="shortname" value="Version courte" />
                        <x-jet-input id="shortname" class="block mt-1 w-full" type="text" placeholder=""
                            wire:model="shortname" />
                        <small class="text-xs text-gray-500">30 caractères maximum</small>
                    </div>
                    <div class="mt-2">
                        <x-jet-label for="description" value="Description" />
                        <x-forms.textarea wire:model="description" cols="30" rows="3" />
                        <small class="text-xs text-gray-500">100 caractères maximum</small>
                    </div>
                    <x-buttons.btn-default type="submit" class="text-sm w-full" wire:loading.attr="disabled">Ajouter
                    </x-buttons.btn-default>
                </form>
            </div>
        </div>
    </x-jet-modal>

    <x-jet-modal wire:model="uiOpenUpdateModal" maxWidth="md">
        <div class="relative bg-white rounded-lg shadow ">
            <button wire:click="$toggle('uiOpenUpdateModal')" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-toggle="authentication-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900">Modification</h3>
                <div>
                    <x-jet-validation-errors class="mb-1" />
                </div>
                <form class="space-y-6" wire:submit.prevent="update">
                    @csrf
                    <div>
                        <x-jet-label for="name" value="Nom du type" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" placeholder=""
                            wire:model="name" />
                        <small class="text-xs text-gray-500">25 caractères maximum</small>
                    </div>
                    <div class="mt-2">
                        <x-jet-label for="shortname" value="Version courte" />
                        <x-jet-input id="shortname" class="block mt-1 w-full" type="text" placeholder=""
                            wire:model="shortname" />
                        <small class="text-xs text-gray-500">25 caractères maximum</small>
                    </div>
                    <div class="mt-2">
                        <x-jet-label for="description" value="Description" />
                        <x-forms.textarea wire:model="description" cols="30" rows="3" />
                        <small class="text-xs text-gray-500">100 caractères maximum</small>
                    </div>
                    <x-buttons.btn-default type="submit" class="text-sm w-full" wire:loading.attr="disabled">
                        Enregistrer
                    </x-buttons.btn-default>
                </form>
            </div>
        </div>
    </x-jet-modal>

    <x-jet-modal wire:model="uiOpenDeleteModal" maxWidth="sm">
        <div class="relative bg-white rounded-lg shadow ">
            <button wire:click="$toggle('uiOpenDeleteModal')" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900">Supprimer le livrable</h3>
                <div class="sm:mt-0 sm:ml-4 sm:text-left">
                    Voulez vous vraiment supprimer ce livrable ? 
                </div>     
                <div class="text-right mt-2">
                    <x-buttons.btn-light type="button" wire:click="$toggle('uiOpenDeleteModal')" lass="text-sm" wire:loading.attr="disabled">Annuler</x-buttons.btn-light>               
                    <x-buttons.btn-red type="button" wire:click="delete"  class="ml-1 text-sm" wire:loading.attr="disabled">Oui</x-buttons.btn-default>
                </div>
            </div>
        </div>
    </x-jet-modal> 

</div>
