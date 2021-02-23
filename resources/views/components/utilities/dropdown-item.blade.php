@props(['href' => false, 'icon' => false, 'paddingX'])

<@if($href === false)p @else()a
                       href="{{ $href }}" @endif {{ $attributes->merge(['class' => ("block px-{$paddingX} py-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700")]) }}>
    @if($icon !== false)
        <x-utilities.icon class="inline mr-3" size="18">{{ $icon }}</x-utilities.icon>
    @endif
    {{ $slot }}
</@if($href === false)p @else()a @endif>
