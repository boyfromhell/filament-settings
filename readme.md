# Filament settings and sitemap

![img](https://github.com/boyfromhell/filament-settings/blob/master/img/img.png)

This package allows for easy setting management using 

[Spatie's ValueStore package](https://github.com/spatie/valuestore)

[Spatie's Generate sitemaps package](https://github.com/spatie/laravel-sitemap)

## Content of the configuration file
```php
return [
    // Group the menu item belongs to
    'group' => 'Settings',
    // Sidebar label
    'label' => 'Settings',
    // Path to the file to be used as storage
    'path' => storage_path('app/settings.json'),
];
```

## Installation

1. Require the package
```shell
composer require ichbin/filament-settings "^v2.0"
```

2. publish the configuration file
```shell
php artisan vendor:publish --tag=filament-settings-config
```

4. (Optionally) you can publish the views for the page and the view used by the livewire component
```shell
php artisan vendor:publish --tag=filament-settings-views
```

## Usage

Define your fields by adding the following in the `boot` method of your `AppServiceProvider`
```php
\IchBin\FilamentSettings\FilamentSettings::setFormFields([
    \Filament\Forms\Components\TextInput::make('title'),
]);
```

After that you can access your values as you usually would using [spatie/valuestore](https://github.com/spatie/valuestore)

Or in blade
```
{{ setting('key') }}
```

### Hiding the page for users

To hide the Settings page from some users add a `canManageSettings` method to your `User` model.

```php
public function canManageSettings(): bool
{
    return $this->can('manage.settings');
}
```

By default the page will be shown to all users.
