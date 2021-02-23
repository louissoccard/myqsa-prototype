@props(['href', 'title', 'description', 'help'])

@php
    $classes = '';
    if(isset($href)) $classes = 'border-2 border-transparent hover:border-blue transition-border-color duration-300 select-none cursor-pointer';
@endphp

@isset($href)<a href="{{ $href }}">@endisset
    <div {{ $attributes->merge(["class" => "flex flex-1 flex-col w-full p-4 bg-gray-100 dark:bg-gray-800 {$classes}"])}}>
        <div class="flex justify-between mb-0.5 pb-2 border-b border-grey-20 dark:border-grey-60">
            <div class="flex items-center">
                <h3 class="text-xl font-bold">{{ $title }}</h3>
            </div>
            @isset($help)
                <x-utilities.dropdown width="w-96">
                    <x-slot name="trigger">
                        <button class="align-middle focus:shadow-outline-purple focus:outline-none"
                                aria-label="Help" aria-haspopup="true">
                            <x-utilities.icon size="18">help-circle</x-utilities.icon>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <p class="text-sm p-3">{!! $help !!}</p>
                    </x-slot>
                </x-utilities.dropdown>
            @endisset
            @isset($href)
                <x-utilities.icon class="ml-1">external-link</x-utilities.icon>
            @endisset
        </div>
        @isset($description)<p class="mt-2 mb-4">{{ $description }}</p>@endisset
        {{ $slot }}
    </div>
    @isset($href)</a>@endisset
