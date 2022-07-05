<div>
    <div class="relative mt-1">
        <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <form action="{{ route('search.results') }}" method="GET">
            <input name="w" value="{{ isset($_GET['w']) ? $_GET['w'] : '' }}" placeholder="Rechercher"
                type="text" id="table-search"
                {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50 pl-7 p-2']) }}>
            <button class="hidden" type="submit"></button>
        </form>
    </div>
</div>
