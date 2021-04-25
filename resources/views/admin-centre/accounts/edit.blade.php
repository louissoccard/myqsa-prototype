@if($view_modal_current_user !== null)
    <x-utilities.dialog-modal wire:model="edit_modal_visible" style="z-index: 100;" zIndex="50">
        <x-slot name="title">Edit {{ Str::namePlural($edit_modal_original_name) }} Account</x-slot>
        <x-slot name="content">
            <div class="px-6">
                <form wire:submit.prevent="saveEditUser">
                    <div class="flex justify-between">
                        <div class="w-1/2 pr-2">
                            <x-utilities.label for="edit-first-name" value="First Name"></x-utilities.label>
                            <x-utilities.input id="edit-first-name" class="block mt-1" type="text" name="first-name"
                                               wire:model="edit_modal_first_name" wire:keydown.enter="saveEditUser"
                                               required autofocus autocomplete="off"></x-utilities.input>
                            <x-utilities.input-error for="edit_modal_first_name" class="mt-2"></x-utilities.input-error>
                        </div>
                        <div class="w-1/2 pl-2">
                            <x-utilities.label for="edit-last-name" value="Last Name"></x-utilities.label>
                            <x-utilities.input id="edit-last-name" class="block mt-1" type="text" name="last-name"
                                               wire:model="edit_modal_last_name" wire:keydown.enter="saveEditUser"
                                               required autocomplete="off"></x-utilities.input>
                            <x-utilities.input-error for="edit_modal_last_name" class="mt-2"></x-utilities.input-error>
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-utilities.label for="edit-email" value="Email"></x-utilities.label>
                        <x-utilities.input id="edit-email" class="block mt-1 w-full" type="email" name="email"
                                           wire:model="edit_modal_email" wire:keydown.enter="saveEditUser"
                                           required autocomplete="off"></x-utilities.input>
                        <x-utilities.input-error for="edit_modal_email" class="mt-2"></x-utilities.input-error>
                    </div>

                    <div class="mt-2">
                        <x-utilities.label for="edit-district" value="District"></x-utilities.label>
                        <x-utilities.select id="edit-district" name="district" wire:model="edit_modal_district_id"
                                            wire:keydown.enter="saveEditUser">
                            @foreach(\App\Models\District::orderBy('name')->get() as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </x-utilities.select>
                        <x-utilities.input-error for="edit_modal_district_id" class="mt-2"></x-utilities.input-error>
                    </div>
                </form>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    Livewire.on('edit-modal-shown', () => {
                        setTimeout(() => document.getElementById('edit-name').focus(), 50);
                    });
                });
            </script>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeEditModal">Cancel</x-utilities.button>
            <x-utilities.button colour="navy" wire:click="saveEditUser" icon="edit">Update</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
@endif
