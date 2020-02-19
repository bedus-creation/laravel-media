<?php

namespace Aammui\LaravelMedia\Traits;

use Aammui\LaravelMedia\Models\Media;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    /**
     * @return void 
     */
    public function addMedia($file)
    {
        $fileUid = $file->storeAs(
            preg_replace('/.[^ .] * $ / ', ' ', $file->hashName()) . '.' . $file->getClientOriginalExtension(),
            'public'
        );

        return $this->media()->create([
            'disk' => 'local',
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
    }

    public function getMedia()
    {
        return $this->media;
    }
}
