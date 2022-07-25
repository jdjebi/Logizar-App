@props(['model', 'label', 'comment','label_title'])

<div>
    <x-jet-label for="{{ $model }}" value="{{ $label }}"/>
    <x-jet-input type="text" id="{{ $model }}" {{ $attributes->merge(['class' => 'block mt-1']) }}
        wire:model="{{ $model }}" />

    @isset($comment)
        <span class="text-sm text-gray-500">{{ $comment }}</span>
    @endisset
</div>
