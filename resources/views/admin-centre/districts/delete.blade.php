<x-utilities.dialog-modal wire:model="delete_modal_visible">
    <x-slot name="title">Delete District</x-slot>
    <x-slot name="content">
        @if($delete_modal_number_of_assigned_users > 0)
            <p>You cannot delete {{ $delete_modal_name }} district because
               there {{ $delete_modal_number_of_assigned_users == 1 ? 'is' : 'are' }}
               still {{ $delete_modal_number_of_assigned_users }} {{ $delete_modal_number_of_assigned_users == 1 ? 'user' : 'users' }}
               assigned to it.</p>
        @else
            <p>Are you sure you want to delete <span>{{ $delete_modal_name }}</span> district?</p>
        @endif
    </x-slot>
    <x-slot name="footer">
        @if($delete_modal_number_of_assigned_users > 0)
            <x-utilities.button wire:click="closeDeleteModal">Okay</x-utilities.button>
        @else
            <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeDeleteModal">Cancel</x-utilities.button>
            <x-utilities.button colour="red" wire:click="deleteDistrict" icon="trash-2">Delete</x-utilities.button>
        @endif
    </x-slot>
</x-utilities.dialog-modal>
