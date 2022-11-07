<x-filament::page>
    <x-filament::form wire:submit.prevent="submit">

        {{ $this->form }}

        <x-tables::button type="submit" class="mt-2">
            @lang('Save')
        </x-tables::button>

    </x-filament::form>
</x-filament::page>
