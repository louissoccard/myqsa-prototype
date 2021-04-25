<div class="inline">
    <x-utilities.button wire:click="showAddModal" icon="plus">Add</x-utilities.button>
    <x-utilities.dialog-modal wire:model="add_modal_visible">
        <x-slot name="title">Add New Cluster</x-slot>
        <x-slot name="content">
            <div class="px-6">
                <form wire:submit.prevent="addCluster">
                    <div>
                        <x-utilities.label for="add-name" value="Name"></x-utilities.label>
                        <x-utilities.input id="add-name" class="block mt-1 w-full" type="text" name="name"
                                           required wire:model="add_modal_name"
                                           wire:keydown.enter="addCluster"></x-utilities.input>
                        <x-utilities.input-error for="add_modal_name" class="mt-2"></x-utilities.input-error>
                    </div>

                    <div class="mt-2">
                        <x-utilities.label for="add-abbreviation" value="Abbreviation"></x-utilities.label>
                        <x-utilities.input id="add-abbreviation" class="block mt-1 w-full uppercase" type="text"
                                           name="abbreviation"
                                           required wire:model="add_modal_abbreviation"
                                           wire:keydown.enter="addCluster"></x-utilities.input>
                        <x-utilities.input-error for="add_modal_abbreviation" class="mt-2"></x-utilities.input-error>
                    </div>
                </form>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        Livewire.on('add-modal-shown', () => {
                            setTimeout(() => document.getElementById('add-name').focus(), 50);
                        });
                    });
                </script>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeAddModal">Cancel</x-utilities.button>
            <x-utilities.button colour="navy" wire:click="addCluster" icon="plus">Add</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
</div>
