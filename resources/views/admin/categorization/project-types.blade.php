<x-layouts.admin>

    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 leading-tight">
            {{ __('Administration') }} / Types de projets       
        </h2>
    </x-slot>

    @livewire('admin.categorization.admin-types-project')

</x-layouts.admin>