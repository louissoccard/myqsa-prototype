<div class="inline">
    <x-utilities.button wire:click="showAddModal" icon="user-plus">Create</x-utilities.button>
    <x-utilities.dialog-modal wire:model="add_modal_visible">
        <x-slot name="title">Create New Account</x-slot>
        <x-slot name="content">
            <div class="px-6">
                <form wire:submit.prevent="addUser">
                    <div class="flex justify-between">
                        <div class="w-1/2 pr-2">
                            <x-utilities.label for="add_modal_first_name" value="First Name"></x-utilities.label>
                            <x-utilities.input id="add_modal_first_name" class="block mt-1" type="text"
                                               name="add_modal_first_name"
                                               required autofocus autocomplete="off" wire:model="add_modal_first_name"
                                               wire:keydown.enter="addUser"></x-utilities.input>
                            <x-utilities.input-error for="add_modal_first_name" class="mt-2"></x-utilities.input-error>
                        </div>
                        <div class="w-1/2 pl-2">
                            <x-utilities.label for="add_modal_last_name" value="Last Name"></x-utilities.label>
                            <x-utilities.input id="add_modal_last_name" class="block mt-1" type="text"
                                               name="add_modal_last_name"
                                               required autocomplete="off" wire:model="add_modal_last_name"
                                               wire:keydown.enter="addUser"></x-utilities.input>
                            <x-utilities.input-error for="add_modal_last_name" class="mt-2"></x-utilities.input-error>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-utilities.label for="add_modal_email" value="Email"></x-utilities.label>
                        <x-utilities.input id="add_modal_email" class="block mt-1 w-full" type="email"
                                           name="add_modal_email"
                                           required autocomplete="off" wire:model="add_modal_email"
                                           wire:keydown.enter="addUser"></x-utilities.input>
                        <x-utilities.input-error for="add_modal_email" class="mt-2"></x-utilities.input-error>
                    </div>

                    <div class="mt-4">
                        <x-utilities.label for="add_modal_password" value="Password"></x-utilities.label>
                        <x-utilities.input id="add_modal_password" class="block mt-1 w-full" type="text"
                                           name="add_modal_password" required
                                           autocomplete="off" wire:model="add_modal_password"
                                           wire:keydown.enter="addUser"></x-utilities.input>
                        <x-utilities.input-error for="add_modal_password" class="mt-2"></x-utilities.input-error>
                    </div>

                    <div class="mt-4">
                        <x-utilities.label for="add_modal_district_id" value="District"></x-utilities.label>
                        <x-utilities.select id="add_modal_district_id" name="add_modal_district_id"
                                            wire:model="add_modal_district_id" wire:keydown.enter="addUser">
                            <option value="null">Select...</option>
                            @foreach(\App\Models\District::orderBy('name')->get() as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </x-utilities.select>
                        <x-utilities.input-error for="add_modal_district_id" class="mt-2"></x-utilities.input-error>
                    </div>
                </form>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        Livewire.on('add-modal-shown', () => {
                            setTimeout(() => document.getElementById('add_modal_first_name').focus(), 50);
                        });
                    });
                </script>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeAddModal">Cancel</x-utilities.button>
            <x-utilities.button type="submit" colour="navy" wire:click="addUser" icon="user-plus">Create
            </x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
</div>
