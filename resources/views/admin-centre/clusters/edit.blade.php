<x-utilities.dialog-modal wire:model="edit_modal_visible">
    <x-slot name="title">Edit {{ $edit_modal_original_name }} Cluster</x-slot>
    <x-slot name="content">
        <div class="px-6">
            <form wire:submit.prevent="editCluster">
                <div>
                    <x-utilities.label for="edit-name" value="Name"></x-utilities.label>
                    <x-utilities.input id="edit-name" class="block mt-1 w-full" type="text" name="name"
                                       required autofocus wire:model="edit_modal_name"
                                       wire:keydown.enter="editCluster"></x-utilities.input>
                    <x-utilities.input-error for="edit_modal_name" class="mt-2"></x-utilities.input-error>
                </div>

                <div class="mt-2">
                    <x-utilities.label for="edit-abbreviation" value="Abbreviation"></x-utilities.label>
                    <x-utilities.input id="edit-abbreviation" class="block mt-1 w-full" type="text" name="abbreviation"
                                       required wire:model="edit_modal_abbreviation"
                                       wire:keydown.enter="editCluster"></x-utilities.input>
                    <x-utilities.input-error for="edit_modal_abbreviation" class="mt-2"></x-utilities.input-error>
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
        <x-utilities.button type="submit" colour="navy" wire:click="editCluster" icon="edit">Update</x-utilities.button>
    </x-slot>
</x-utilities.dialog-modal>
