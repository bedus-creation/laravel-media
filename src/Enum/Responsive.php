<?php

namespace Aammui\LaravelMedia\Enum;

use Illuminate\Support\Arr;

/**
 * Class Responsive
 * @package Aammui\LaravelMedia\Enum
 */
class Responsive
{
    public const SM        = "sm";
    public const MD        = "md";
    public const LG        = "lg";


    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return collect(config('laravel-media.responsive'))->toArray();
    }

    /**
     * @param string $key
     *
     * @return array|\ArrayAccess|mixed
     */
    public static function getWidthFromConfig(string $key)
    {
        $sizes = self::getConfig();

        return Arr::get($sizes, "$key.w");
    }

    /**
     * @param string $key
     *
     * @return array|\ArrayAccess|mixed
     */
    public static function getHeightFromConfig(string $key)
    {
        $sizes = self::getConfig();

        return Arr::get($sizes, "$key.h");
    }
}
