@props(['href', 'title', 'progressId' => null, 'percentage' => null])
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'w-full xl:w-1/2']) }}>
    <div class="bg-grey-5 dark:bg-gray-800 p-4 border-2 border-transparent hover:border-blue
            transition-all duration-300 select-none cursor-pointer">
        <div class="flex justify-between pb-2 mb-8 border-b border-grey-20 dark:border-grey-60">
            <h3 class="text-xl font-bold">{{ $title }}</h3>
            <x-utilities.icon>external-link</x-utilities.icon>
        </div>

        @if($progressId !== null)
            <div class="flex flex-row">
                <x-utilities.circular-progress-bar barId="{{ $progressId }}"
                                                   data-percentage="{{ $percentage }}">
                </x-utilities.circular-progress-bar>

                {{ $slot }}
            </div>
        @else
            {{ $slot }}
        @endisset
    </div>
</a>
