<div>
    <div class="mb-2 text-sm pl-3">
        @foreach ($categories_selected as $category)
            <div class="mb-1">
                <a wire:click="removeCategory({{ $loop->index }})" href="javascript:void(0)" class="active:focus:bg-red-300 inline-flex items-center p-1 mr-2 text-sm font-semibold text-red-800 bg-red-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg>
                </a>
                @if ($category['type'] == 'system')
                    <span>{{ $category['name'] }}</span>
                @else
                    <span>Autre({{ $category['name'] }})</span>
                @endif
            </div>
        @endforeach
    </div>
    <div class="flex items-center">
        <x-forms.select name="category" class="block mt-1" wire:model="category_selected_id">
            <option value="">Sélectionnez une catégorie</option>
            @foreach ($categories as $category)
                @if (!in_array($category->id, $categories_tabou))
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
            <option value="other">Autre</option>
        </x-forms.select>
        @if ($category_selected_id == 'other')
            <x-jet-input id="other_category_content" class="block mt-1 w-full ml-3" type="text"
                wire:model.defer="other_category_content" placeholder="Titre de la catégorie" />
        @endif
    </div>
    <div class="mt-5">
        <x-jet-button type="button" class="py-2 px-2.5" wire:click="addCategory" :disabled="$add_category_disabled">Ajouter
        </x-jet-button>
    </div>
</div>
