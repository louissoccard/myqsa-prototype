@props(['colour' => 'navy', 'textColour' => 'white', 'disabled' => false, 'icon' => null])

<button
    {{ $attributes->merge(['type' => 'submit', 'class' => "flex items-center px-4 py-2 bg-{$colour} rounded-none font-bold text-sm text-{$textColour} hover:bg-{$colour}-darkened focus:outline-none focus:border-grey-60 dark:focus:border-grey-20 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"]) }}
    @if($disabled == true) disabled="" @endif>
    @if($icon !== null)
        <x-utilities.icon class="inline mr-1" size="18">{{$icon}}</x-utilities.icon> @endif
    <span class="leading-none">{{ $slot }}</span>
</button>
