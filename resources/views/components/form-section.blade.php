@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="shadow overflow-hidden rounded-none">
                <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        {{ $form }}
                    </div>
                </div>

                @if (isset($actions))
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>