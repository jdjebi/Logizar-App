
@props(['id', 'message','model'])

<div {{ $attributes->merge(["class"=>"flex items-center cursor-pointer"]) }}>
    <x-jet-input :id="$id" class="mr-2 cursor-pointer" type="checkbox" wire:model='{{ $model }}' :value="old($id)"/>
    <x-jet-label :for="$id" :value="$message" class="cursor-pointer"/>
</div>