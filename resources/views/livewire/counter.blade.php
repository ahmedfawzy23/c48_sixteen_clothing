<div>
    <button wire:click="decrease">-</button>
    <span>{{ $count }}</span>
    <button wire:click="increase">+</button>

    <input type="text" wire:model.live.debounce.300ms="name">

    <p>Hi, {{ $name }}</p>

</div>