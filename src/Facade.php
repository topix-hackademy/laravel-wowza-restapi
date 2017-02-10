<?php

namespace Topix\Hackademy\LaravelWowza;

use Topix\Hackademy\LaravelWowza\Handler\WowzaHandlerSdk;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return WowzaHandlerSdk::class; // Keep this in mind
    }

}