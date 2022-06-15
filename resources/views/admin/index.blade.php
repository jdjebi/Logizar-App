<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration') }} / Catégories
        </h2>
    </x-slot>

   <div class="pb-3">
        @livewire('admin.admin-categories-manager')
   </div>

</x-app-layout>
