@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 bg-red-500 text-white text-sm font-medium leading-5 focus:outline-none focus:bg-red-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 bg-red-400 text-white text-sm font-medium leading-5 hover:bg-red-500 focus:outline-none focus:bg-red-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
