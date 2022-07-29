<x-app-layout>
    <x-slot name="extras_css">
        <style>
            .min-h-screen {
                background-color: #fff !important;
            }
        </style>
    </x-slot>

    <x-slot name="search-content">
        {{ $search_content }}
    </x-slot>

    <div class="px-4 my-2">
        <div class="grid grid-cols-1 md:grid-cols-6">
            <div class="mb-3 md:mb-0 ">
                @livewire('menus.categorization.categorization-sidebar')
            </div>
            <div class="col-span-5 md:ml-3">
                @if ($nbr_results == 0)
                    <div class="p-10 text-center">
                        <span class="text-lg semi-bold">Aucun résultat</span>
                    </div>
                @else
                    <div>
                        @livewire('projects.project-simple-card-empty-list', ['projects' => $results, 'show_counter' => true])
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
