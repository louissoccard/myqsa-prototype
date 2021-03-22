@props(['default'])
<th {{ $attributes->merge(['class' => 'px-2 py-3 border-b-2 border-grey-20 dark:border-gray-700 select-none text-left cursor-pointer']) }} @isset($default) data-sorted="true"
    data-sorted-direction="ascending" @endisset>
    {{ $slot }}
    <x-utilities.icon class="hidden sorting-arrow" size="16">chevron-down</x-utilities.icon>
    <x-utilities.icon class="inline no-sorting" size="16">minus</x-utilities.icon>
</th>
