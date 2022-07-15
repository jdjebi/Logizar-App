<div>

    <div class="mb-2 pt-1 hidden md:block">
        <span class="uppercase text-xs font-semibold">Categéroies</span>
    </div>

    <div x-data="{ open: false }" class="block md:hidden relative">
        <div class="h-10 bg-white flex border border-gray-center items-center rounded">
            <div class="px-4 text-gray-800 w-full">
                <span class="uppercase text-xs font-semibold">Catégories</span>
            </div>
            <label for="show_more" @click="open=(open ? false : true)"
                class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-2 fill-current" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                </svg>
            </label>
        </div>
        <div x-show="open" @click.outside="open = false"
            class="absolute rounded bg-gray-50 shadow overflow-hidden flex flex-col w-full mt-1 border border-gray-200">
            @foreach ($categories as $category)
                <label for="combo-category-{{ $category->id }}"
                    class="flex items-center cursor-pointer p-2 py-3 border-transparent border-l-4 hover:bg-blue-600 hover:text-white">
                    <input id="combo-category-{{ $category->id }}"
                        wire:change='toggleCategorySelection({{ $category->id }})' id="checkbox-{{ $category->id }}"
                        type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-800 focus:ring-2">
                    <div class="ml-4">{{ $category->name }}</div>
                </label>
            @endforeach
        </div>
    </div>

    <aside class="hidden md:block" aria-label="Sidebar">
        <div class="overflow-y-auto border py-4 px-3 bg-gray-50 border-slate-300 rounded">
            <div>
                <ul class="space-y-2">
                    @foreach ($categories as $category)
                        <li>
                            <a href="javascript:void(0)"
                                class="flex items-center p-2 text-xs  text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <div class="flex items-center hover:cursor-pointer">
                                    <input wire:change='toggleCategorySelection({{ $category->id }})'
                                        id="checkbox-{{ $category->id }}" type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label class="ml-2 text-xs font-medium text-gray-900 hover:cursor-pointer"
                                        for="checkbox-{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div id="dropdown-cta" class="p-4 mt-6 bg-blue-50 rounded-lg" role="alert">
            <div class="flex items-center mb-3">
               <span class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded">Info</span>
            </div>
            <p class="mb-3 text-sm text-blue-900 dark:text-blue-400">
                Logizar est un projet en open-source pour l'instant. Vous pouvez contribuer en toute en liberté.
            </p>
            <a class="text-sm text-blue-900 underline hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300" href="https://github.com/jdjebi/Logizar-App">Contribuer au projet</a>
         </div>
    </aside>

</div>
