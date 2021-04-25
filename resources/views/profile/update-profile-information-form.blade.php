<x-interface.card title="Update Account Information" description="Update your account's information and email address.">

    <x-account.form submit="updateProfileInformation">
        <!-- Name -->
        <div class="flex items-center justify-between mb-2">
            <div class="pr-2 w-1/2">
                <x-utilities.label for="first_name" value="First Name"></x-utilities.label>
                <x-utilities.input id="first_name" type="text" class="mt-1 block" wire:model.defer="state.first_name"
                                   autocomplete="given-name"></x-utilities.input>
                <x-utilities.input-error for="first_name" class="mt-2"></x-utilities.input-error>
            </div>
            <div class="pl-2 w-1/2">
                <x-utilities.label for="last_name" value="Last Name"></x-utilities.label>
                <x-utilities.input id="last_name" type="text" class="mt-1 block" wire:model.defer="state.last_name"
                                   autocomplete="first_name"></x-utilities.input>
                <x-utilities.input-error for="family-name" class="mt-2"></x-utilities.input-error>
            </div>
        </div>

        <!-- Email -->
        <div class="mb-2">
            <x-utilities.label for="email" value="Email"></x-utilities.label>
            <x-utilities.input id="email" type="email" class="mt-1 block w-full"
                               wire:model.defer="state.email"></x-utilities.input>
            <x-utilities.input-error for="email" class="mt-2"></x-utilities.input-error>
        </div>

        <div x-data="{ changed: {{ Auth::user()->district->id }} }">
            <x-utilities.label for="district" value="District"></x-utilities.label>
            <x-utilities.select id="district" wire:model.defer="state.district_id"
                                @change="changed = $event.target.value">
                @foreach(\App\Models\District::orderBy('name')->get() as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </x-utilities.select>
            <div class="flex flex-row justify-between items-center mt-4 py-2 px-4 bg-gray-200 dark:bg-gray-700"
                 x-show="changed != {{ Auth::user()->district->id }}">
                <div>
                    <p class="block">Changing your district will change who can view your record.</p>
                    <p class="block">This should only be done if you move districts.</p>
                </div>

                <x-utilities.icon class="ml-2">alert-circle</x-utilities.icon>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.on('refresh-navigation-dropdown', () => {
                    document.querySelectorAll('.user-name').forEach((name) => {
                        name.innerHTML = document.getElementById('first_name').value + ' ' + document.getElementById('last_name').value;
                    });

                    let districtName = document.getElementById('district');
                    document.querySelectorAll('.user-district').forEach((district) => {
                        district.innerHTML = districtName.options[districtName.selectedIndex].text;
                    });
                });
            });
        </script>

        <x-slot name="footer">
            <x-utilities.action-message class="mr-3" on="saved">Saved.</x-utilities.action-message>
            <x-utilities.button wire:loading.attr="disabled" wire:target="photo">Save</x-utilities.button>
        </x-slot>
    </x-account.form>
</x-interface.card>
