<div class="inline cursor-pointer" wire:click="viewUserAward({{ $model->id }})">
    <x-utilities.icon>award</x-utilities.icon>
</div>
<div class="inline cursor-pointer" wire:click="showViewModal({{ $model->id }})">
    <x-utilities.icon>settings</x-utilities.icon>
</div>
