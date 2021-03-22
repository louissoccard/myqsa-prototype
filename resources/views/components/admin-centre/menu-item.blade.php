<a {{ $attributes->merge(['class' => 'w-full md:w-1/2 lg:w-1/3']) }}>
    <div
        class="flex items-center bg-grey-5 dark:bg-gray-800 border-2 border-transparent hover:border-blue p-4 select-none cursor-pointer">
        <x-utilities.icon class="mr-4">{{ $icon }}</x-utilities.icon>
        <p class="text-lg font-bold">{{ $slot }}</p>
    </div>
</a>
