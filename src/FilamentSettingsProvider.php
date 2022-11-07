<?php

namespace IchBin\FilamentSettings;

use Filament\PluginServiceProvider;
use Livewire\Livewire;
use IchBin\FilamentSettings\Components\RenderValues;
use IchBin\FilamentSettings\Pages\Settings;
use Spatie\LaravelPackageTools\Package;

class FilamentSettingsProvider extends PluginServiceProvider
{
    public static string $name = 'filament-settings';

    protected function getPages(): array
    {
        return [
            Settings::class,
        ];
    }
}
