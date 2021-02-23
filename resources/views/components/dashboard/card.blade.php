@props(['title', 'numberOfElements', 'overflow' => 'true'])

{{-- Must use {!! $title !!} otherwise the title's special characters are HTML encoded (e.g. & becomes &amp; on the front end) --}}
<x-interface.card title="{!! $title !!}" {{ $attributes->merge(['class' => 'lg:w-1/2 mb-4 lg:mb-0']) }}>
    <div class="w-full @if($overflow) max-h-60 overflow-auto @endif">
        {{ $slot }}
    </div>
    @if(4 <= $numberOfElements)
        <x-utilities.icon size="18" class="w-full text-center">chevron-down</x-utilities.icon> @endif
</x-interface.card>
