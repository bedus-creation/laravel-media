<?php

namespace Aammui\LaravelMedia\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

trait StandAloneMedia
{
    use HasStorage;
    use HasBuilder;

    public function getMedia()
    {
        $query = $this->_query;

        $this->resetBuilder();

        if (empty($query)) {
            return $this->get();
        };
        return $this->where($query)->get();
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
        return $this->create(
            [
                'disk'       =>$this->_disk,
                'collection' => $this->_collection,
                'model_id'   => $this->id,
                'model_type' => get_class($this),
                'base_url'   => $this->_host ?? url('/'),
                'in_json'    => json_encode($urls),
            ]
        );
    }
}
