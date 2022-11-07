<?php

namespace IchBin\FilamentSettings\Pages;

use Filament\Pages\Page;
use Spatie\Valuestore\Valuestore;
use Filament\Pages\Actions\Action;
use Spatie\Sitemap\SitemapGenerator;
use IchBin\FilamentSettings\FilamentSettings;

class Settings extends Page
{
    public array $data;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament-settings::pages.settings';

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getFormSchema(): array
    {
        return FilamentSettings::$fields;
    }

    public function mount(): void
    {
        $this->form->fill(
            Valuestore::make(
                config('filament-settings.path')
            )->all()
        );
    }

    public function submit(): void
    {
        $this->validate();

        foreach ($this->data as $key => $data) {
            Valuestore::make(
                config('filament-settings.path')
            )->put($key, $data);
        }

        $this->notify('success', 'Saved!');
    }

    protected function getActions(): array
    {
        return [
            Action::make('sitemap')->action('generateSitemap')->label(__('Generate Sitemap')),
        ];
    }

    public function generateSitemap()
    {
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));

        $this->notify('success', __("Sitemap Generated Success"));
    }


    protected static function getNavigationGroup(): ?string
    {
        return config('filament-settings.group');
    }

    protected static function getNavigationLabel(): string
    {
        return config('filament-settings.label');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        if (auth()->user() && !method_exists(auth()->user(), 'canManageSettings')) {
            return true;
        }
    }
}
