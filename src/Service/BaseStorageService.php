<?php

namespace Aammui\LaravelMedia\Service;

use Illuminate\Http\FileHelpers;
use Illuminate\Support\Facades\Storage;

/**
 * Class BaseStorageService
 * @package Aammui\LaravelMedia\Service
 */
class BaseStorageService
{
    use FileHelpers;

    /**
     * @param $disk
     * @param $directory
     * @param $file
     *
     * @return bool
     */
    public static function upload($disk, $directory, $file)
    {
        return Storage::disk($disk)->put($directory, $file);
    }

    public static function download($disk, $url, $type = "")
    {
        $file = Storage::disk($disk)->get($url);
    }
}
