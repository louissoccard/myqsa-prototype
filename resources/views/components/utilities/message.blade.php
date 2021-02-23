@props(['colour', 'text_colour'])

<div {{ $attributes->merge(['class' => "text-sm bg-{$colour} text-white px-4  py-2"]) }}>
    {{ $slot }}
</div>
