<div>
    {{--    <div class="fixed bg-white dark:bg-gray-900 px-16 py-4 right-20 bottom-10 z-50 shadow-lg select-none cursor-default" wire:loading.delay>--}}
    {{--            <x-utilities.icon class="inline align-middle animate-spin mr-1">loader</x-utilities.icon>--}}
    {{--            <p class="inline align-middle text-lg font-bold">Loading</p>--}}
    {{--    </div>--}}
    <div class="flex flex-row justify-between items-end">
        <div class="flex flex-row items-center mb-3">
            <x-utilities.input id="search" type="text" class="inline align-middle" width="60" placeholder="Search"
                               wire:model="search"></x-utilities.input>
            <x-utilities.label class="inline align-middle z-10 -ml-8 align-middle" for="search">
                <x-utilities.icon class="inline" size="18">search</x-utilities.icon>
            </x-utilities.label>
        </div>

        @if($header_view)
            <div class="flex mb-3">
                @include($header_view)
            </div>
        @endif
    </div>

    <div class="w-full">
        @if($models->isEmpty())
            <p class="p-4 bg-gray-100 dark:bg-gray-800">No results to display.</p>
        @else
            <div>
                <div class="overflow-x-auto">
                    <table
                        class="w-full table-fixed bg-grey-5 dark:bg-gray-800 border-b-2 border-grey-20 dark:border-gray-700 mb-4 {{ $table_class }}">
                        <thead class="{{ $thead_class }}">
                            <tr class="text-left bg-gray-200 dark:bg-grey-80">
                                @if($checkbox && $checkbox_side == 'left')
                                    @include('laravel-livewire-tables::checkbox-all')
                                @endif

                                @isset($row_numbers)
                                    <th class="w-16 px-4 py-3 border-b-2 border-grey-20 dark:border-gray-700 select-none text-left align-middle {{ $this->thClass('rowNumbers') }}">
                                        #
                                    </th>
                                @endisset

                                @foreach($columns as $column)
                                    <th class="px-4 py-3 border-b-2 border-grey-20 dark:border-gray-700 select-none align-middle {{ $this->thClass($column->attribute) }} @if($column->sortable) cursor-pointer @endif"
                                        @if($column->sortable) wire:click="sort('{{ $column->attribute }}')" @endif>
                                        @if($column->sortable)
                                            <span>
                                            {{ $column->heading }}

                                                @if($sort_attribute == $column->attribute)
                                                    <x-utilities.icon class="inline align-middle"
                                                                      size="16">chevron-{{ $sort_direction == 'asc' ? 'up' : 'down' }}</x-utilities.icon>
                                                @else
                                                    <x-utilities.icon class="inline align-middle"
                                                                      size="16">minus</x-utilities.icon>
                                                @endif
                                        </span>
                                        @else
                                            {{ $column->heading }}
                                        @endif
                                    </th>
                                @endforeach

                                @if($checkbox && $checkbox_side == 'right')
                                    @include('laravel-livewire-tables::checkbox-all')
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $model)
                                <tr class="hover:bg-gray-200 dark:hover:bg-grey-80 text-left {{ $this->trClass($model) }}">
                                    @if($checkbox && $checkbox_side == 'left')
                                        @include('laravel-livewire-tables::checkbox-row')
                                    @endif

                                    @isset($row_numbers)
                                        <th class="align-middle px-4 py-2 border-b border-grey-20 dark:border-gray-700 {{ $this->tdClass('rowNumbers', $row_numbers[$model['id']]) }}">
                                            {{ $row_numbers[$model['id']] }}
                                        </th>
                                    @endisset

                                    @foreach($columns as $column)
                                        <td class="align-middle px-4 py-2 border-b border-grey-20 dark:border-gray-700 {{ $this->tdClass($column->attribute, $value = Arr::get($model->toArray(), $column->attribute)) }}">
                                            @if($column->view)
                                                @include($column->view)
                                            @else
                                                {{ $value }}
                                            @endif
                                        </td>
                                    @endforeach

                                    @if($checkbox && $checkbox_side == 'right')
                                        @include('laravel-livewire-tables::checkbox-row')
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <div class="flex flex-row justify-between w-full">
        <div class="flex-1">
            {{ $models->links() }}
        </div>
        @if($footer_view)
            <div class="flex-1">
                @include($footer_view)
            </div>
        @endif
    </div>
</div>
