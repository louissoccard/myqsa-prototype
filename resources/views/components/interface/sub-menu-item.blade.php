@props(['active' => false, 'href' => false])

@php
    $classes = ' w-full pl-6 pr-3 py-1.5 select-none';
    if ($active == true) {
        $classes .= '';
    } else if($href !== false) {
        $classes .= '  cursor-pointer text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900';
    } else {
    	$classes .= ' cursor-default text-gray-500 dark:text-gray-400';
    }
@endphp


<li class="relative px-3">
    @if($active)
        <span class="absolute inset-y-0 left-0 w-1 bg-navy dark:bg-white" aria-hidden="true"></span>
    @endif


    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => ("inline-block" . $classes)]) }}>
        {{ $slot }}
    </a>
</li>

