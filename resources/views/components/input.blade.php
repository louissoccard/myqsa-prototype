@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-300 dark:text-gray-100 focus:outline-none focus:ring-navy focus:border-navy focus:z-10 sm:text-sm shadow-sm']) !!}>
