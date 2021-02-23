<x-interface.card title="Delete Account"
                  description="Once your account is deleted, all of its resources and data will be permanently
                                      deleted. Before deleting your account, please download any data or information
                                      that you wish to retain.">

    <div class="flex flex-1 flex-col justify-between">
        <span></span>

        <div class="flex justify-end w-full mt-4">
            <x-utilities.button wire:click="confirmUserDeletion" wire:loading.attr="disabled" colour="red">Delete
                                                                                                           Account
            </x-utilities.button>
        </div>
    </div>

    {{-- Delete User Confirmation Modal --}}
    <x-utilities.dialog-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">Delete Account</x-slot>

        <x-slot name="content">
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and
            data will be permanently deleted. Please enter your password to confirm you would like to permanently
            delete your account.

            <div class="mt-4" x-data="{}"
                 x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-utilities.input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}"
                                   x-ref="password"
                                   wire:model.defer="password"
                                   wire:keydown.enter="deleteUser"></x-utilities.input>

                <x-utilities.input-error for="password" class="mt-2"></x-utilities.input-error>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-utilities.button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled"
                                colour="grey-60">Nevermind
            </x-utilities.button>

            <x-utilities.button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled" colour="red">
                Delete Account
            </x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
</x-interface.card>
