@props(['colour' => 'navy', 'textColour' => 'white', 'disabled' => false, 'icon' => null])

<a {{ $attributes->merge(['type' => 'submit', 'class' => "inline align-middle px-4 py-2 bg-{$colour} rounded-none font-bold text-sm text-{$textColour} hover:bg-{$colour}-darkened focus:outline-none focus:border-grey-60 dark:focus:border-grey-20 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 appearance-none"]) }}
   @if($disabled == true) disabled="" @endif>
    @if($icon !== null) <span class="inline mr-1"><x-utilities.icon class="inline"
                                                                    size="18">{{$icon}}</x-utilities.icon></span> @endif
    <span class="inline">{{ $slot }}</span>
</a>
