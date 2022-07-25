@props(['model', 'label'])
<div>
    <x-jet-label for="{{ $model }}" value="{{ $label }}" />
    <x-forms.textarea {{ $attributes->merge(['class' => 'block mt-1']) }} wire:model="{{ $model }}" />
</div>
