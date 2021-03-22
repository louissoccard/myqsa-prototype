<div class="inline">
    <x-utilities.button wire:click="showAddModal" icon="plus">Add</x-utilities.button>
    <x-utilities.dialog-modal wire:model="add_modal_visible">
        <x-slot name="title">Add New District</x-slot>
        <x-slot name="content">
            <div class="px-6">
                <form wire:submit.prevent="addDistrict">
                    <div>
                        <x-utilities.label for="add-name" value="Name"></x-utilities.label>
                        <x-utilities.input id="add-name" class="block mt-1 w-full" type="text" name="name"
                                           required autofocus wire:model="add_modal_name"
                                           wire:keydown.enter="addDistrict"></x-utilities.input>
                        <x-utilities.input-error for="add_modal_name" class="mt-2"></x-utilities.input-error>
                    </div>

                    <div class="mt-2">
                        <x-utilities.label for="cluster" value="Cluster"></x-utilities.label>
                        <x-utilities.select id="cluster" name="cluster" wire:model="add_modal_cluster_id"
                                            wire:keydown.enter="addDistrict">
                            <option value="null">Select...</option>
                            @foreach(\App\Models\Cluster::all() as $cluster)
                                <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                            @endforeach
                        </x-utilities.select>
                        <x-utilities.input-error for="add_modal_cluster_id" class="mt-2"></x-utilities.input-error>
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
            <x-utilities.button colour="navy" wire:click="addDistrict" icon="plus">Add</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
</div>
