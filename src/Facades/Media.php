<?php

namespace Aammui\LaravelMedia\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Aammui\LaravelMedia\Models\Media toDisk(string $name)
 * @method static \Aammui\LaravelMedia\Models\Media fromDisk(string $name)
 * @method static \Illuminate\Database\Eloquent\Collection getMedia()
 */
class Media extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'media';
    }
}
