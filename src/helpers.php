<?php

use Spatie\Valuestore\Valuestore;

if (!function_exists('setting')) {
    function setting($key)
    {
        $valuestore = Valuestore::make(config('filament-settings.path'));
        return $valuestore->get($key, 'default'); // Returns 'default'
    }
}
