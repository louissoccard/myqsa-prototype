@props(['firstName'])
@php
    date_default_timezone_set("Europe/London");

    $timeOfDay = 'morning';
    $currentHour = date('H');

    if (12 <= $currentHour && 17 > $currentHour) {
        $timeOfDay = 'afternoon';
    } else if (17 <= $currentHour && $currentHour <= 22) {
        $timeOfDay = 'evening';
    } else if (23 <= $currentHour || $currentHour < 6) {
        $timeOfDay = 'night';
    }
@endphp

<h1 {{ $attributes->merge(['class' => 'text-2xl font-black']) }}>Good {{ $timeOfDay }}, {{ $firstName }}.</h1>
