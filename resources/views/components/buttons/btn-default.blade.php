@php
$classes = "px-4 py-2 inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm focus:outline-none"
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>