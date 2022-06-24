<div>
    @if ($categories)
        @foreach ($categories as $category)
            @if ($category->type == 'system')
                <x-badges.badge class="bg-blue-100 text-blue-800">{{ $category->name }}</x-badges.badge>
            @elseif($category->type == 'other')
                <x-badges.badge class="bg-purple-100 text-purple-800">{{ $category->name }}</x-badges.badge>
            @endif
        @endforeach
    @else
        <x-badges.badge class="bg-yellow-100 text-yellow-800">Projet</x-badges.badge>
    @endif
</div>
