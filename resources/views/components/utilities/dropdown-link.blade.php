@props(['hover' => 'gray-200', 'darkHover' => 'gray-800', 'hoverText' => 'gray-700', 'darkHoverText' => 'gray-200'])

<a {{ $attributes->merge(['class' => "block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-200 hover:text-{$hoverText} dark:hover:text-{$darkHoverText} hover:bg-{$hover} dark:hover:bg-{$darkHover} focus:outline-none focus:bg-{$hover} dark:focus:bg-{$darkHover} transition duration-150 ease-in-out"]) }}>{{ $slot }}</a>
