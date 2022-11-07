<?php

use Spatie\Valuestore\Valuestore;

if (!function_exists('setting')) {
    function setting($key)
    {
        $valuestore = Valuestore::make(storage_path('app/settings.json'));
        return $valuestore->get($key, 'default'); // Returns 'default'
    }
}
