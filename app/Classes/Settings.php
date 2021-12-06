<?php
namespace App\Classes;

use Illuminate\Support\Facades\Storage;

class Settings
{
    public static $privateData = '';

    public static function loadSettings()
    {
        if (Storage::disk('local')->exists(env('PRIVATE_FILENAME')) === false) {
            return false;
        }

        self::$privateData = Storage::disk('local')->get(env('PRIVATE_FILENAME'));

        return true;
    }

    public static function get()
    {
        return self::$privateData;
    }
}
