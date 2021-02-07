<?php

namespace Aammui\LaravelMedia\Models;

use Aammui\LaravelMedia\Enum\Extension;
use Aammui\LaravelMedia\Enum\Responsive;
use Aammui\LaravelMedia\Traits\StandAloneMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Media extends Model
{
    use StandAloneMedia;

    protected $table = "medias";

    protected $fillable = ['disk', 'in_json', 'base_url', 'url', 'collection', 'model_type', 'model_id'];

    protected $casts = [
        'in_json' => 'object',
    ];

    /**
     * @param string $type
     * @param null   $image
     *
     * @return string
     */
    public function link($type = Responsive::SM, $image = null): string
    {
        $url = Arr::get(json_decode($this->in_json, true), "url.{$type}");

        return $this->base_url.$url;
    }
}
