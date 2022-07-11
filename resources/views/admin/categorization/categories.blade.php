<x-layouts.admin>

    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 leading-tight">
            {{ __('Administration') }} / Catégories       
        </h2>
    </x-slot>

    @livewire('admin.categorization.admin-categories')

</x-layouts.admin>