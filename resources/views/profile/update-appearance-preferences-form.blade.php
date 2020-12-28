<x-form-section submit="updateAppearancePreferences">
    <x-slot name="title">
        {{ __('Appearance') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Change your preferred appearance with settings such as dark mode.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="dark_mode_preference" value="{{ __('Dark Mode') }}"></x-label>
            <x-select id="dark_mode_preference" wire:model="dark_mode_preference">
                <option value="light">Light</option>
                <option value="dark">Dark</option>
                <option value="auto">Automatic</option>
            </x-select>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.on('dark_mode_updated', value => {
                    window.darkMode.update(value);
                });
            });
        </script>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        @error('dark_mode_preference')
        <x-message class="mr-3" on="error" colour="red" text_colour="white">
            {{ __("Something has gone wrong. Please try again later.") }}
        </x-message>
        @enderror

        <x-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
