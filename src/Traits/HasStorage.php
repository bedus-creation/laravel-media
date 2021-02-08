<?php

namespace Aammui\LaravelMedia\Traits;

use Aammui\LaravelMedia\Service\FileStorageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Trait HasStorage
 * @package Aammui\LaravelMedia\Traits
 */
trait HasStorage
{
    /**
     * @param $file
     *
     * @return Model
     */
    public function addMedia($file): Model
    {
        $urls = (new FileStorageService($file, $this->_disk))->store();

        $media = $this->storeModel($urls);

        $this->resetBuilder();

        return $media;
    }

    /**
     * @param $url
     *
     * @return Model
     */
    public function addMediaFromUrl($url)
    {
        $url         = parse_url($url);
        $this->_host = $url['scheme'].'://'.$url['host'];
        $path        = $url['path'];

        $urls = [
            "url" => [
                "sm" => $url['path'],
                "md" => $url['path'],
                "lg" => $url['path'],
            ],
        ];

        return $this->storeModel($urls);
    }
}
