<?php

namespace Aammui\LaravelMedia\Service\Implement;

use Illuminate\Support\Facades\Storage;

class FileSystem
{
    public static function upload($disk, $directory, $file)
    {
        return Storage::disk($disk)->put($directory, $file);
    }
    public static function download($disk, $url, $type = "")
    {
        $file = Storage::disk($disk)->get($url);
    }
}
