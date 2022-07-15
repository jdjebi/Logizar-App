<div>
    <div>
        <x-jet-input class="block mt-1 w-full" type="text" placeholder="Entrez les tags" wire:model="tagsInput" wire:keyup='tagsInputUpdate'/>
    </div>
    <div class="text-sm text-gray-500">Les tags doivent être séparés par des virgules.</div>
    <div class="mt-3">
        @foreach ($tags as $tag)
            <x-badges.badge class="bg-blue-100 text-blue-800">{{ $tag }}</x-badges.badge>
        @endforeach
    </div>
</div>