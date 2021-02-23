@props(['align' => 'right', 'width' => 'w-48', 'contentClasses' => 'bg-white dark:bg-gray-900', 'var' => 'open'])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'origin-top-right right-0';
            break;
    }
@endphp

<div class="relative" @if($var === 'open') x-data="{ open: false }" @endif @click.away="{{ $var }} = false"
     @close.stop="{{ $var }} = false">
    <div @click="{{ $var }} = ! {{ $var }}">
        {{ $trigger }}
    </div>

    <div x-show="{{ $var }}"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-50 mt-2 {{ $width }} rounded-none shadow-lg {{ $alignmentClasses }}"
         style="display: none;">
        <div class="rounded-none shadow {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
