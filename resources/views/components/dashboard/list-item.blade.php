@props(['daysPast', 'color' => ''])

<a class="flex flex-row justify-between items-center hover:bg-gray-200 dark:hover:bg-gray-900 cursor-pointer px-4 py-2">
    <div class="inline-block">
        <div>
            <h4 class="text-lg">{{ $slot }}</h4>
        </div>
        <p class="font-light text-sm">@if($daysPast == 0) Today @else {{ $daysPast }} days ago @endif</p>
    </div>
    @if($color != '')
        <span class="w-2 h-2 bg-{{ $color }}"></span>
    @endif
</a>
