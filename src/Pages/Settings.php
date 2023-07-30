<?php

namespace IchBin\FilamentSettings\Pages;

use Filament\Livewire\Notifications;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use IchBin\FilamentSettings\FilamentSettings;
use Spatie\Valuestore\Valuestore;
use Filament\Notifications\Notification;
use Filament\Actions\Action;

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

    public function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
        ];
    }

    public function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('Save'))
            ->submit('save')
            ->keyBindings(['mod+s']);
    }

    public function getSubmitFormAction(): Action
    {
        return $this->getSaveFormAction();
    }

    public function submit(): void
    {
        $this->validate();

        try {
            foreach ($this->data as $key => $data) {
                Valuestore::make(
                    config('filament-settings.path')
                )->put($key, $data);
            }
        }catch (Halt $exception) {
            return;
        }
        $this->getSavedNotification()?->send();
    }

    public function getSavedNotification(): ?Notification
    {
        $title = $this->getSavedNotificationTitle();

        if (blank($title)) {
            return null;
        }

        return Notification::make()
            ->success()
            ->title($title);
    }

    public function getSavedNotificationTitle(): ?string
    {
        return $this->getSavedNotificationMessage() ?? __('Saved');
    }

    protected function getSavedNotificationMessage(): ?string
    {
        return null;
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filament-settings.group');
    }

    public static function getNavigationLabel(): string
    {
        return config('filament-settings.label');
    }

    public static function shouldRegisterNavigation(): bool
    {
        if (auth()->user() && !method_exists(auth()->user(), 'canManageSettings')) {
            return true;
        }
        return false;
    }
}
