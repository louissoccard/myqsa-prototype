@props(['id' => null, 'maxWidth' => null, 'backgroundDismissible' => true])

<x-utilities.modal :id="$id" :maxWidth="$maxWidth" :backgroundDismissible="$backgroundDismissible" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg dark:text-white font-bold">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex items-stretch justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800">
        {{ $footer }}
    </div>
</x-utilities.modal>
