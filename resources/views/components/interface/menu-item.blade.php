@props(['active' => false, 'href' => false, 'icon' => false])

@php
    $classes = ' w-full px-3 py-3 select-none';
    if ($active == true) {
        $classes .= '';
    } else if($href !== false) {
        $classes .= '  cursor-pointer text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900';
    } else {
    	$classes .= ' cursor-default text-gray-500 dark:text-gray-400';
    }
@endphp


<div class="relative px-3">
    @if($active)
        <span class="absolute inset-y-0 left-0 w-1 bg-navy dark:bg-white" aria-hidden="true"></span>
    @endif

    @if($icon == false)
        <div class="inline-block" style="width: calc(0.75rem + 18px)">&nbsp;</div>
    @endif

    <@if($href === false || $active == true)p @else()a href="{{ $href }}" @endif
        {{ $attributes->merge(['class' => ("inline-block font-bold" . $classes)]) }}>

        @if($icon !== false)
            <x-utilities.icon class="inline mr-3" size="18">{{ $icon }}</x-utilities.icon>
        @endif

        {{ $slot }}

    </@if($href === false || $active == true)p @else()a @endif>
</div>
