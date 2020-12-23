@props(['active'])

@php
    $classes = ($active ?? false)
    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-navy dark:border-white text-sm font-bold leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-navy transition duration-150 ease-in-out'
    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>