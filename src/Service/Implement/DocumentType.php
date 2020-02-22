<?php

namespace Aammui\LaravelMedia\Service\Implement;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Config;

class DocumentType extends FileSystem implements MediaTypeInterface
{
    protected $disk = "s3-doc";

    protected $sizes = ["big" => 600, "medium" => 300, "small" => 100];

    protected $base_url;

    public function __construct()
    {
        $this->base_url = Config::get('filesystems.disks.' . $this->disk . '.url');
    }

    public function link($data, $size = "big")
    {
        return $data->base_url . json_decode($data->in_json)->url->$size;
    }

    public function getMediaData($userId)
    {
        return [
            'user_id' => $userId,
            'type' => 'file',
            'base_url' => $this->base_url,
            'in_json' => json_encode([
                'url' => $this->getUploadedUrl()
            ]),
        ];
    }

    public function getUploadedUrl()
    {
        $path = "attachments" . "/";
        parent::upload($this->disk, $path, request()->file);
        return [
            "small" => $path . request()->file->hashName(),
            "medium" => $path . request()->file->hashName(),
            "big" => $path . request()->file->hashName()
        ];
    }
}
