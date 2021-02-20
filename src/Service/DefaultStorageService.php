<?php

namespace Aammui\LaravelMedia\Service;

use Aammui\LaravelMedia\Enum\Responsive;
use Aammui\LaravelMedia\Service\Interfaces\FileStorageInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Collection;

/**
 * Class DefaultStorageService
 * @package Aammui\LaravelMedia\Service
 */
class DefaultStorageService extends BaseStorageService implements FileStorageInterface
{
    /**
     * @param File|UploadedFile $file
     * @param string            $disk
     *
     * @return array
     * @todo implement type check with minimum PHP 8
     */
    public function store($file, string $disk): array
    {
        $path = "/documents";

        parent::upload($disk, $path, $file);

        $fileHash = $file->hashName();

        return [
            "url" => $this->prepareURL($path, $fileHash),
        ];
    }

    /**
     * @param $path
     *
     * @return Collection
     */
    public function prepareURL($path, $fileHash): Collection
    {
        $sizes = Responsive::getConfig();

        return collect($sizes)->map(
            function ($value, $key) use ($path, $fileHash) {
                return $path . "/" . $fileHash;
            }
        );
    }
}
