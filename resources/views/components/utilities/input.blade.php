@props(['disabled' => false, 'width' => 'full'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "appearance-none rounded-none relative w-{$width} px-3 py-2 border border-gray-100 placeholder-gray-500 text-gray-900 dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-300 dark:text-gray-100 focus:outline-none focus:ring-navy dark:focus:ring-grey-40 focus:border-navy dark:focus:border-grey-40 focus:z-10 sm:text-sm"]) !!}>
