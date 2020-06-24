<?php

namespace Aammui\LaravelMedia\Facades;

use Illuminate\Support\Facades\Facade;

class Media extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'media';
    }
}
