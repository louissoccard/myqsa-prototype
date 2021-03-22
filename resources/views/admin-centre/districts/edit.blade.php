<x-utilities.dialog-modal wire:model="edit_modal_visible">
    <x-slot name="title">Edit {{ $edit_modal_original_name }} District</x-slot>
    <x-slot name="content">
        <div class="px-6">
            <form wire:submit.prevent="editDistrict">
                <div>
                    <x-utilities.label for="edit-name" value="Name"></x-utilities.label>
                    <x-utilities.input id="edit-name" class="block mt-1 w-full" type="text" name="name"
                                       required autofocus wire:model="edit_modal_name"
                                       wire:keydown.enter="editDistrict"></x-utilities.input>
                    <x-utilities.input-error for="edit_modal_name" class="mt-2"></x-utilities.input-error>
                </div>

                <div class="mt-2">
                    <x-utilities.label for="edit-cluster" value="Cluster"></x-utilities.label>
                    <x-utilities.select id="edit-cluster" name="cluster" wire:model="edit_modal_cluster_id"
                                        wire:keydown.enter="editDistrict">
                        @foreach(\App\Models\Cluster::all() as $cluster)
                            <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                        @endforeach
                    </x-utilities.select>
                    <x-utilities.input-error for="edit_modal_cluster_id" class="mt-2"></x-utilities.input-error>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.on('users-district-name-changed', value => {
                    document.querySelectorAll('.user-district').forEach((district) => {
                        district.innerHTML = value;
                    });
                });

                Livewire.on('edit-modal-shown', () => {
                    setTimeout(() => document.getElementById('edit-name').focus(), 50);
                });
            });
        </script>
    </x-slot>
    <x-slot name="footer">
        <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeEditModal">Cancel</x-utilities.button>
        <x-utilities.button colour="navy" wire:click="editDistrict" icon="edit">Update</x-utilities.button>
    </x-slot>
</x-utilities.dialog-modal>
