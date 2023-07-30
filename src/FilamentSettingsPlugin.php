<?php

namespace IchBin\FilamentSettings;

use Filament\Contracts\Plugin;
use Filament\Panel;
use IchBin\FilamentSettings\Pages\Settings;

class FilamentSettingsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-settings';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Settings::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
