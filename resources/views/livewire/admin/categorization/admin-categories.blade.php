<div>
    <div class="flex justify-between items-center flex-wrap mb-4 sm:mb-1">
        <div class="flex justify-between items-center">
            <div class="p-4">
                <h6 class="font-semibold">Catégories</h6>
            </div>
            <div>
                <div class="p-4">
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input placeholder="Rechercher une catégorie" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5">
                    </div>
                </div>
            </div>
        </div>
        <div class="pl-4">
            <x-buttons.default wire:click='openCreateModal' href="#add">Ajouter</x-buttons>
        </div>
    </div>
    <x-tables.simple-table.table tbodyStyle="odd:bg-white even:bg-gray-50">
        <x-slot name="columns">
            <x-tables.simple-table.th>#</x-tables.simple-table.th>
            <x-tables.simple-table.th>Nom</x-tables.simple-table.th>
            <x-tables.simple-table.th>Slug</x-tables.simple-table.th>
            <x-tables.simple-table.th>Date modification</x-tables.simple-table.th>
            <x-tables.simple-table.th class="text-right">Actions</x-tables.simple-table.th>
        </x-slot>
        <x-slot name="rows">
            @foreach ($categories as $category)  
                <x-tables.simple-table.row class="odd:bg-white even:bg-gray-50">
                    <x-tables.simple-table.td class="font-medium text-gray-900 whitespace-nowrap">{{ $loop->index + 1 }}</x-tables.simple-table.td>
                    <x-tables.simple-table.td class="font-medium text-gray-900">{{ $category->name }}</x-tables.simple-table.td>
                    <x-tables.simple-table.td>{{ $category->slug }}</x-tables.simple-table.td>
                    <x-tables.simple-table.td>{{ $category->updated_at->format("d/m/Y") }}</x-tables.simple-table.td>
                    <x-tables.simple-table.td class="text-right">
                        <x-buttons.light wire:click='openUpdateModal({{ $category->id }})' href="#edit" class="text-xs">Modifier</x-buttons>
                        <x-buttons.red wire:click='openDeleteModal({{ $category->id }})' href="#delete" class="text-xs mr-0">Supprimer</x-buttons>
                    </x-tables.simple-table.td>
                </x-tables.simple-table.row>
            @endforeach
        </x-slot>
    </x-tables.simple-table.table>

    <x-jet-modal wire:model="uiOpenCreateModal" maxWidth="sm">
        <div class="relative bg-white rounded-lg shadow ">
            <button wire:click="$toggle('uiOpenCreateModal')" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900">Ajouter une catégorie</h3>
                <div>
                    <x-jet-validation-errors class="mb-1" />
                </div>
                <form class="space-y-6" wire:submit.prevent="create">
                    @csrf
                    <div>
                        <x-jet-label for="categoryName" value="Titre de la catégorie" />
                        <x-jet-input id="categoryName" class="block mt-1 w-full" type="text" placeholder="Education" wire:model="name" />
                    </div>                    
                    <x-buttons.btn-default type="submit" class="text-sm w-full" wire:loading.attr="disabled">Ajouter</x-buttons.btn-default>
                </form>
            </div>
        </div>
    </x-jet-modal> 

    <x-jet-modal wire:model="uiOpenUpdateModal" maxWidth="sm">
        <div class="relative bg-white rounded-lg shadow ">
            <button wire:click="$toggle('uiOpenUpdateModal')" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900">Mise à jour</h3>
                <div>
                    <x-jet-validation-errors class="mb-1" />
                </div>
                <form class="space-y-6" wire:submit.prevent="update">
                    @csrf
                    <div>
                        <div class="mb-2" >
                            <x-jet-label for="categoryName" value="Titre de la catégorie" />
                            <x-jet-input id="categoryName" class="block mt-1 w-full" type="text" placeholder="Education" wire:model="name" />
                        </div>
                        <div>
                            <x-jet-label for="categorySlug" value="Slug" />
                            <x-jet-input id="categorySlug" class="block mt-1 w-full" type="text" wire:model="slug" disabled />
                        </div>
                    </div>     
                    <div class="text-right">
                        <x-buttons.btn-light type="button" wire:click="$toggle('uiOpenUpdateModal')" lass="text-sm" wire:loading.attr="disabled">Annuler</x-buttons.btn-light>               
                        <x-buttons.btn-default type="submit" wire:click='"' class="ml-1 text-sm" wire:loading.attr="disabled">Enregistrer</x-buttons.btn-default>
                    </div>
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
                <h3 class="mb-4 text-xl font-medium text-gray-900">Supprimer la catégorie</h3>
                <div class="sm:mt-0 sm:ml-4 sm:text-left">
                    Voulez vous vraiment supprimer la catégorie ? 
                </div>     
                <div class="text-right mt-2">
                    <x-buttons.btn-light type="button" wire:click="$toggle('uiOpenDeleteModal')" lass="text-sm" wire:loading.attr="disabled">Annuler</x-buttons.btn-light>               
                    <x-buttons.btn-red type="button" wire:click="delete"  class="ml-1 text-sm" wire:loading.attr="disabled">Oui</x-buttons.btn-default>
                </div>
            </div>
        </div>
    </x-jet-modal> 

</div>