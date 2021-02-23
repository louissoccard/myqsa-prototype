<x-interface.card title="Update Password"
                  description="Ensure your account is using a long, random password to stay secure."
                  id="update-password">

    <x-account.form submit="updatePassword">
        <div class="mb-2">
            <x-utilities.label for="current_password" value="Current Password"></x-utilities.label>
            <x-utilities.input id="current_password" type="password" class="mt-1 block w-full"
                               wire:model.defer="state.current_password"
                               autocomplete="current-password"></x-utilities.input>
            <x-utilities.input-error for="current_password" class="mt-2"></x-utilities.input-error>
        </div>

        <div class="mb-2">
            <x-utilities.label for="password" value="New Password"></x-utilities.label>
            <x-utilities.input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password"
                               autocomplete="new-password"></x-utilities.input>
            <x-utilities.input-error for="password" class="mt-2"></x-utilities.input-error>
        </div>

        <div>
            <x-utilities.label for="password_confirmation" value="Confirm Password"></x-utilities.label>
            <x-utilities.input id="password_confirmation" type="password" class="mt-1 block w-full"
                               wire:model.defer="state.password_confirmation"
                               autocomplete="new-password"></x-utilities.input>
            <x-utilities.input-error for="password_confirmation" class="mt-2"></x-utilities.input-error>
        </div>
        <x-slot name="footer">
            <x-utilities.action-message class="mr-3" on="saved">Saved.</x-utilities.action-message>
            <x-utilities.button>Save</x-utilities.button>
        </x-slot>

    </x-account.form>
</x-interface.card>
