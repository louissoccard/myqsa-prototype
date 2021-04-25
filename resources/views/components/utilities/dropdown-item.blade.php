@props(['href' => false, 'icon' => false, 'iconPos' => 'start', 'paddingX'])

@php

    $positionClasses = 'flex items-center';
    if ($iconPos === 'end') {
        $positionClasses .= ' justify-between';
    }

@endphp

<@if($href === false)p @else()a
                       href="{{ $href }}" @endif {{ $attributes->merge(['class' => ("{$positionClasses} px-{$paddingX} py-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700")]) }}>
    @if($icon !== false && $iconPos === 'start')
        <x-utilities.icon class="inline mr-1.5" size="18">{{ $icon }}</x-utilities.icon>
    @endif
    {{ $slot }}
    @if($icon !== false && $iconPos === 'end')
        <x-utilities.icon class="inline ml-auto" size="18">{{ $icon }}</x-utilities.icon>
    @endif
</@if($href === false)p @else()a @endif>
