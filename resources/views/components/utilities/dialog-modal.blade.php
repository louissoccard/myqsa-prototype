@props(['id' => null, 'maxWidth' => null, 'zIndex' => '30', 'backgroundDismissible' => true])

<x-utilities.modal :id="$id" :maxWidth="$maxWidth" :backgroundDismissible="$backgroundDismissible"
                   :zIndex="$zIndex" {{ $attributes }}>
    <div class="px-6 py-4">
        @isset($title)
            <div class="text-lg dark:text-white font-bold">
                {{ $title }}
            </div>
        @endisset

        <div @isset($title) class="mt-4" @endisset>
            {{ $content }}
        </div>
    </div>

    <div class="flex items-stretch justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800">
        {{ $footer }}
    </div>
</x-utilities.modal>
