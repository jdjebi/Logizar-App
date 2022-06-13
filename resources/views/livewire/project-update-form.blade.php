<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">Description du projet</h3>
        
                <p class="mt-1 text-sm text-gray-600">
                    Décrivez textuellement les détails de votre projet. N'hésitez pas à vous exprimer, vous êtes libre !
                </p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">

            <x-jet-validation-errors class="mb-4" />

            <form wire:submit.prevent="submit">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Nom') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="Description" />
                            <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" wire:model="description" cols="30" rows="10"></textarea>                
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <x-jet-button>Enregistrer</x-jet-button>
                </div>
            </form>

        </div> 

    </div>

</div>
