<x-filament-widgets::widget>
    <x-filament::section>
       <label for="">
        <input type="radio" type="radio" class="rounded" value="en" wire:model='localEn' wire:click='switchLocale("rn")' >
        <span>English</span>
       </label>
       <label for="">
        <input type="radio" type="radio" class="rounded" value="id" wire:model='localId' wire:click='switchLocale("id")' >
        <span>Bahasa Indonesia</span>
       </label>
    </x-filament::section>
</x-filament-widgets::widget>
