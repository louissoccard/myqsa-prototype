<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span
                            class="relative inline-flex items-center px-4 py-2 text-sm bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 cursor-default">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button wire:click="previousPage" wire:loading.attr="disabled" dusk="previousPage.before"
                                class="relative inline-flex items-center px-4 py-2 bg-white bg-gray-900 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition-text-color ease-in-out duration-150">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" wire:loading.attr="disabled" dusk="nextPage.before"
                                class="relative inline-flex items-center px-4 py-2 ml-3 bg-white  dark:bg-gray-900 border border-gray-300 dark:border-gray-700 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition-text-color ease-in-out duration-150">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span
                            class="relative inline-flex items-center px-4 py-2 ml-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 cursor-default">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="">
                        <span>{!! __('Showing') !!}</span>
                        <span class="">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('of') !!}</span>
                        <span class="">{{ $paginator->total() }}</span>
                        <span>{!! __('results') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 cursor-default"
                                        aria-hidden="true">
                                        <x-utilities.icon size="20">chevron-left</x-utilities.icon>
                                    </span>
                                </span>
                            @else
                                <button wire:click="previousPage" dusk="previousPage.after" rel="prev"
                                        class="relative inline-flex items-center px-2 py-2 bg-whit dark:bg-gray-800 border border-gray-300 dark:border-gray-700 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition-text-color ease-in-out duration-150"
                                        aria-label="{{ __('pagination.previous') }}">
                                        <x-utilities.icon size="20">chevron-left</x-utilities.icon>
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm text-white bg-navy dark:bg-gray-900 border border-gray-300 dark:border-gray-700 cursor-default">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button wire:click="gotoPage({{ $page }})"
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition-text-color ease-in-out duration-150"
                                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button wire:click="nextPage" dusk="nextPage.after" rel="next"
                                        class="relative inline-flex items-center px-2 py-2 -ml-px bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition-text-color ease-in-out duration-150"
                                        aria-label="{{ __('pagination.next') }}">
                                    <x-utilities.icon size="20">chevron-right</x-utilities.icon>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 -ml-px bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 cursor-default"
                                        aria-hidden="true">
                                    <x-utilities.icon size="20">chevron-right</x-utilities.icon>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
