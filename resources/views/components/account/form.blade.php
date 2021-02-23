<form wire:submit.prevent="{{ $submit }}" class="flex flex-1 flex-col justify-between">
    <div>
        {{ $slot }}
    </div>

    <div class="flex justify-end w-full mt-4">
        {{ $footer }}
    </div>
</form>
