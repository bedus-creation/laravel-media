<?php

namespace Aammui\LaravelMedia\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "medias";

    protected $fillable = ['disk', 'in_json', 'base_url', 'url', 'collection', 'model_type', 'model_id'];

    public function getPath($type = 'small')
    {
        return optional(json_decode($this->in_json)->path)->$type ??
            optional(json_decode($this->in_json)->path)->small ??
            optional(json_decode($this->in_json)->path)->medium;
    }

    public function link($type = 'small', $image = null)
    {
        $url = optional(json_decode($this->in_json)->url)->$type ??
            optional(json_decode($this->in_json)->url)->small ??
            optional(json_decode($this->in_json)->url)->medium;
        return $this->base_url . $url;
    }
}
