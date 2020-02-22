<?php

namespace Aammui\LaravelMedia\Service\Implement;

use App\Repositories\Eloquent\Utils\Media\ImageType;
use App\Repositories\Eloquent\Utils\Media\FileType;
use App\Repositories\Contracts\Utils\MediaInterface;

class MediaRepository implements MediaInterface
{
    protected $model;
    protected $mediaType;

    public function __construct(Media $model)
    {
        $this->model = $model;
    }

    public function upload($file)
    {
        $images =  '.jpg,.png,.gif,.jpeg';
        $docs = '.pdf,.doc,.xls,.docx,.xlsx';

        dd($file->getClientOriginalExtension());

        $method = $type . "TypeDataProvider";
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw \Exception("Invalid File Type");
        }
        $data = $this->mediaType->getMediaData($userId);
        return $this->model->create($data);
    }

    private function imageTypeDataProvider()
    {
        $this->mediaType = new ImageType();
    }

    private function fileTypeDataProvider()
    {
        $this->mediaType = new FileType();
    }

    public function getUrl()
    {
    }

    public function getTempUrl()
    {
    }

    public function delete()
    {
    }
}
