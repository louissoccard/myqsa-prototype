<div>
    <a class="inline mr-2 cursor-pointer" wire:click="showEditModal({{ $model->id }})">
        <x-utilities.icon size="20">edit</x-utilities.icon>
    </a>
    <a class="inline cursor-pointer" wire:click="showDeleteModal({{ $model->id }})">
        <x-utilities.icon size="20">trash-2</x-utilities.icon>
    </a>
</div>
