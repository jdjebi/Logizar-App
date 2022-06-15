@php
$classes = "px-4 py-2 inline-block focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm"
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>