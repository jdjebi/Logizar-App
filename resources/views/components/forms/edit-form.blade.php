@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
            <p class="mt-1 text-sm text-gray-600">{{ $description }}</p>
        </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <x-jet-validation-errors class="mb-4" />
        <form wire:submit.prevent="{{ $submit }}">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                {{ $actions }}
            </div>
        </form>
    </div>
</div>