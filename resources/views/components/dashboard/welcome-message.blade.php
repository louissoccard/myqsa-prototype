@props(['firstName'])
@php
    $timeOfDay = 'morning';
    $currentHour = date('H');

    if (12 < $currentHour && 17 > $currentHour) {
        $timeOfDay = 'afternoon';
    } else if (17 <= $currentHour && $currentHour <= 23) {
        $timeOfDay = 'evening';
    }
@endphp

<h1 {{ $attributes->merge(['class' => 'text-2xl font-black']) }}>Good {{ $timeOfDay }}, {{ $firstName }}.</h1>
