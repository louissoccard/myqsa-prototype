@props(['colour' => 'navy', 'text_colour' => 'white', 'dark_text_colour' => 'white'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-2 py-1 bg-{$colour} border-4 border-{$colour} rounded-none font-bold text-sm text-{$text_colour} hover:bg-transparent hover:text-{$colour} dark:hover:text-{$dark_text_colour} focus:outline-none focus:border-grey-60 dark:focus:border-grey-20 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</button>
