@props(['colour' => 'navy', 'text_colour' => 'white'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-4 py-2 bg-{$colour} border border-{$colour} rounded-none font-bold text-sm text-{$text_colour} hover:bg-{$colour}-darkened hover:border-{$colour}-darkened focus:outline-none focus:border-grey-60 dark:focus:border-grey-20 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</button>
