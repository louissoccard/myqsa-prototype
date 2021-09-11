@if($view_modal_current_user !== null)
    <x-utilities.dialog-modal wire:model="districts_modal_visible" zIndex="100">
        <x-slot name="title">{{ Str::namePlural($view_modal_current_user->first_name) }} District Access</x-slot>
        <x-slot name="content">
            <x-utilities.label for="district_select" value="District"></x-utilities.label>
            <x-utilities.select wire:model="districts_modal_current" wire:change="districtUpdated" id="district_select"
                                class="mb-4">
                <option value="none">Please select...</option>
                @foreach(\App\Models\District::all() as $district)
                    <option value="{{ $district["id"] }}">{{ $district["name"] }}</option>
                @endforeach
            </x-utilities.select>


            <div class="flex flex-col items-center">
                <div class="flex items-center justify-between w-min min-w-1/2 mb-4">
                    <p class="mr-4">View District</p>
                    @if($districts_modal_current_can_view !== null)
                        @if($districts_modal_current === 'none')
                            <x-utilities.button color="grey-40" disabled>Grant</x-utilities.button>
                        @elseif($districts_modal_current_can_view == true)
                            <x-utilities.button colour="red"
                                                wire:click="revokeDistrictView('{{ $districts_modal_current }}')">Revoke
                            </x-utilities.button>
                        @else
                            <x-utilities.button colour="green" wire:click="grantDistrictView({{ $districts_modal_current }})">Grant
                            </x-utilities.button>
                        @endif
                    @endif
                </div>

                <div class="flex items-center justify-between w-min min-w-1/2">
                    <p class="mr-4">Edit District</p>
                    @if($districts_modal_current_can_edit !== null)
                        @if($districts_modal_current === 'none')
                            <x-utilities.button color="grey-40" disabled>Grant</x-utilities.button>
                        @elseif($districts_modal_current_can_edit == true)
                            <x-utilities.button type="button" colour="red"
                                                wire:click="revokeDistrictEdit('{{ $districts_modal_current }}')">Revoke
                            </x-utilities.button>
                        @else
                            <x-utilities.button type="button" colour="green"
                                                wire:click="grantDistrictEdit('{{ $districts_modal_current }}')">Grant
                            </x-utilities.button>
                        @endif
                    @endif
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-utilities.button colour="grey-60" class="mr-2" wire:click="closeDistrictsModal">Close
            </x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
@endif
