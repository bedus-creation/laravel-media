<?php

namespace Aammui\LaravelMedia\Enum;

use ArrayAccess;
use Illuminate\Support\Arr;

/**
 * Class Extension
 * @package Aammui\LaravelMedia\Enum
 */
class Extension
{
    public const IMAGE    = "image";
    public const DOCUMENT = "document";

    /**
     * @param $extension
     *
     * @return bool
     */
    public static function isImage(string $extension): bool
    {
        return in_array($extension, self::getImageExtension(self::IMAGE));
    }

    /**
     * @param string $extension
     *
     * @return bool
     */
    public static function isDocument(string $extension): bool
    {
        return in_array($extension, self::getImageExtension(self::DOCUMENT));
    }

    /**
     * @param string $key
     *
     * @return array|ArrayAccess|mixed
     */
    private static function getImageExtension(string $key)
    {
        $extension = config('laravel-media.extension');

        $extension = Arr::get($extension, $key);

        return explode(',', $extension);
    }
}
