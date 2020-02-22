<?php

namespace Aammui\LaravelMedia\Traits;

use Aammui\LaravelMedia\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

trait HasMedia
{
    protected $toCollection;

    protected $query;

    public function media()
    {
        $query = $this->morphMany(Media::class, 'model');
        if (!empty($this->query)) {
            $query = $query->where($this->query);
        };
        return $query;
    }

    public function toCollection($name)
    {
        $this->toCollection = $name;
        return $this;
    }

    public function fromCollection($name)
    {
        $this->query['collection'] = $name;
        return $this;
    }

    /**
     * @return void 
     */
    public function addMedia($file)
    {
        $fileUid = Storage::disk('public')->putFileAs('documents', $file, $file->hashName());
        $media = $this->media()->create([
            'disk' => 'local',
            'collection' => $this->toCollection,
            'model_id' => $this->id,
            'model_type' => get_class($this),
            'base_url' => url('/'),
            'in_json' => json_encode([
                'url' => [
                    'small' => Storage::url($fileUid),
                    'medium' => Storage::url($fileUid),
                    'big' => Storage::url($fileUid),
                ],
                'path' => [
                    'small' => storage_path('app/public') . '/' . $fileUid,
                    'medium' => storage_path('app/public') . '/' . $fileUid,
                    'big' => storage_path('app/public') . '/' . $fileUid,
                ]
            ]),
        ]);
        $this->toCollection = null;
        return $media;
    }

    public function getMedia()
    {
        $media = $this->media()->get();
        $this->query = [];
        return $media;
    }

    public function addMediaFromPath($path)
    {
        $file = new File($path);
        return $this->addMedia($file);
    }
}
