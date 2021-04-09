<?php

namespace Aammui\LaravelMedia\Service;

use Aammui\LaravelMedia\Enum\Extension;
use Aammui\LaravelMedia\Service\Interfaces\FileStorageInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;

/**
 * Class FileStorageService
 * @package Aammui\LaravelMedia\Service
 */
class FileStorageService
{
    /**
     * @var FileStorageInterface
     */
    protected $storageService;

    /**
     * @var UploadedFile|File
     */
    protected $file;

    /**
     * @var string
     */
    protected $disk;

    /**
     * @param UploadedFile|File $file
     * @param string            $disk
     *
     * @todo implement type check with minimum PHP 8
     *
     * FileStorageService constructor.
     *
     */
    public function __construct($file, string $disk)
    {
        $this->file = $file;

        $this->disk = $disk;

        $this->initStorageService();
    }

    public function initStorageService()
    {
        $extension = $this->file->guessExtension();
        if (Extension::isImage($extension)) {
            $this->imageStorageService();
        } else {
            $this->defaultStorageService();
        }
    }

    private function imageStorageService()
    {
        $this->storageService = new ImageStorageService();
    }

    private function defaultStorageService()
    {
        $this->storageService = new DefaultStorageService();
    }

    /**
     * @return mixed
     */
    public function store()
    {
        return $this->storageService->store($this->file, $this->disk);
    }
}
