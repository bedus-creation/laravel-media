<?php

namespace Aammui\LaravelMedia\Service\Implement;

use Aammui\LaravelMedia\Service\Interfaces\MediaInterface;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Config;

class ImageType extends FileSystem implements MediaInterface
{
    protected $disk = "s3-img";

    protected $sizes = ["big" => 600, "medium" => 300, "small" => 100, "x-small" => 52];

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
            'type' => 'image',
            'base_url' => $this->base_url,
            'in_json' => json_encode([
                'url' => $this->getUploadedUrl()
            ]),
        ];
    }

    public function getUploadedUrl()
    {
        $url = [];
        foreach ($this->sizes as $key => $size) {
            $path = $key . "/" . request()->file->hashName();
            $this->resizeImage($size, $path);
            $url[$key] = $path;
        }
        return $url;
    }

    public function resizeImage($size, $path)
    {
        $img = Image::make(request()->file);

        $img = $img->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        parent::upload($this->disk, $path, $img->stream()->detach());
    }
}
