<?php

namespace Aammui\LaravelMedia\Traits;

use Aammui\LaravelMedia\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

trait HasMedia
{
    use HasStorage;
    use HasBuilder;

    /**
     * @return MorphMany
     */
    public function media(): MorphMany
    {
        $query = $this->morphMany(Media::class, 'model');

        if ( !empty($this->_query) ) {
            $query = $query->where($this->_query);
        }

        return $query;
    }

    /**
     * @return Collection
     */
    public function getMedia(): Collection
    {
        $media = $this->media()->get();

        $this->resetBuilder();

        return $media;
    }

    public function addMediaFromPath($path)
    {
        $file = new File($path);

        return $this->addMedia($file);
    }

    /**
     * @param array $urls
     *
     * @return Model
     */
    public function storeModel(array $urls): Model
    {
        return $this->media()->create(
            [
                'disk'       => 'local',
                'collection' => $this->_collection,
                'model_id'   => $this->id,
                'model_type' => get_class($this),
                'base_url'   => $this->_host ?? url('/'),
                'in_json'    => json_encode($urls),
            ]
        );
    }
}
