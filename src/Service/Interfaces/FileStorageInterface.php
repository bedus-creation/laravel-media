<?php


namespace Aammui\LaravelMedia\Service\Interfaces;


use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

interface FileStorageInterface
{
    /**
     * @param \Illuminate\Http\File|UploadedFile $file
     * @param string                             $disk
     *
     * @return array
     * @todo implement type check with minimum PHP 8
     */
    public function store($file, string $disk): array;
}
