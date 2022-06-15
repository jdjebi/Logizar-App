@php
$classes = "px-4 py-2 inline-block text-gray-900 bg-white border border-gray-300 rounded-md focus:outline-none hover:bg-gray-100 focus:ring-4 font-medium  text-sm transition"
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>