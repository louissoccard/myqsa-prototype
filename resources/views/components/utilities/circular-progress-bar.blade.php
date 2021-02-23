@props(['barId', 'containerClass' => ''])

@php
    $classes = '';
    if ($slot != '') {
        $classes = ' mb-4';
    }
@endphp

<div class="flex flex-col justify-center items-center w-1/2 lg:w-auto {{ $containerClass }}">
    <div id="{{ $barId }}" {{ $attributes->merge(['class' => "relative max-w-xxs{$classes}"]) }}></div>
    @if($slot != '') <p class="flex-1 text-center">{{ $slot }}</p> @endif
</div>
