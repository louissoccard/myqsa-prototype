<x-interface.card title="Appearance" description="Change your preferred appearance with settings such as dark mode.">

    <x-account.form submit="updateAppearancePreferences">

        <x-utilities.label for="dark_mode_preference" value="Dark Mode"></x-utilities.label>
        <x-utilities.select id="dark_mode_preference" wire:model="dark_mode_preference">
            <option value="light">Light</option>
            <option value="dark">Dark</option>
            <option value="auto">Automatic</option>
        </x-utilities.select>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.on('dark_mode_updated', value => {
                    window.darkMode.update(value);
                });
            });
        </script>

        <x-slot name="footer">
            <x-utilities.action-message class="mr-3" on="saved">Saved.</x-utilities.action-message>

            @error('dark_mode_preference')
            <x-utilities.message class="mr-3" on="error" colour="red" text_colour="white">
                Something has gone wrong. Please try again later.
            </x-utilities.message>
            @enderror

            <x-utilities.button>Save</x-utilities.button>
        </x-slot>

    </x-account.form>
</x-interface.card>
