<x-interface.card title="Update Account Information" description="Update your account's information and email address.">

    <x-account.form submit="updateProfileInformation">
        <!-- Name -->
        <div class="mb-2">
            <x-utilities.label for="name" value="Name"></x-utilities.label>
            <x-utilities.input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                               autocomplete="name"></x-utilities.input>
            <x-utilities.input-error for="name" class="mt-2"></x-utilities.input-error>
        </div>

        <!-- Email -->
        <div>
            <x-utilities.label for="email" value="Email"></x-utilities.label>
            <x-utilities.input id="email" type="email" class="mt-1 block w-full"
                               wire:model.defer="state.email"></x-utilities.input>
            <x-utilities.input-error for="email" class="mt-2"></x-utilities.input-error>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.on('refresh-navigation-dropdown', value => {
                    document.getElementById('user-name').innerHTML = document.getElementById('name').value;
                });
            });
        </script>

        <x-slot name="footer">
            <x-utilities.action-message class="mr-3" on="saved">Saved.</x-utilities.action-message>
            <x-utilities.button wire:loading.attr="disabled" wire:target="photo">Save</x-utilities.button>
        </x-slot>
    </x-account.form>
</x-interface.card>
