@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block pl-3 pr-4 py-2 border-l-4 border-navy dark:border-white text-base font-bold text-gray-900 dark:text-white bg-gray-200 dark:bg-gray-800 focus:outline-none focus:text-black dark:focus:text-white focus:bg-gray-200 dark:focus:bg-gray-800 focus:border-navy transition duration-150 ease-in-out'
                : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-100 hover:bg-white dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-800 dark:focus:text-gray-50 focus:bg-gray-50 dark:focus:bg-gray-900 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
