<?php

namespace Aammui\LaravelMedia\Traits;

use Aammui\LaravelMedia\Models\Media;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    protected $toCollection;

    protected $query;

    public function media()
    {
        return $this->morphMany(Media::class, 'model')->where($this->query);
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
        $fileUid = $file->storeAs(
            'documents',
            preg_replace('/.[^ .] * $ / ', ' ', $file->hashName()) . '.' . $file->getClientOriginalExtension(),
            'public'
        );

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
}
