<?php

namespace IchBin\FilamentSettings;

class FilamentSettings
{
    public static array $fields = [];

    public static function setFormFields(array $fields): void
    {
        self::$fields = $fields;
    }
}
