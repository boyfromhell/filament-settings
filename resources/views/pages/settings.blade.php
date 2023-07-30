<x-filament-panels::page>
    <x-filament-panels::form wire:submit.prevent="submit">

        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
            />
{{--        <x-tables::button type="submit" class="mt-2">--}}
{{--            @lang('Save')--}}
{{--        </x-tables::button>--}}

    </x-filament-panels::form>
</x-filament-panels::page>
