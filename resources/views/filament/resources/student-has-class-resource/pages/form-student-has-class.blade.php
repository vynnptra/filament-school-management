<x-filament-panels::page>
    <form wire:submit='save'>
        {{ $this->form }}
        <button type="submit" class="mt-4 bg-yellow-600 px-4 hover:bf-yellow-500 text-white font-bold py-3 rounded ">Save</button>
    </form>
</x-filament-panels::page>
