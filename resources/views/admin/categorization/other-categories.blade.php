<x-layouts.admin>

    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 leading-tight">
            {{ __('Administration') }} / Autre carégories       
        </h2>
    </x-slot>

    @livewire('admin.categorization.admin-other-categories')

</x-layouts.admin>