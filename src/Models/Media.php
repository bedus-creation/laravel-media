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
        'in_json' => 'array',
    ];

    /**
     * @param string $type
     * @param null   $image
     *
     * @return string
     */
    public function link($type = Responsive::SM, $image = null): string
    {
        $json = $this->in_json;

        if (!is_array($json)) {
            $json = json_decode($json, true);
        }

        $url = Arr::get($json, "url.{$type}") ?? Arr::get($json, "url.small") ?? Arr::get($json, "url.medium") ?? Arr::get($json, "url.big") ?? "assets/img/icon.png";

        return $this->base_url . $url;
    }
}
