<?php

namespace Aammui\LaravelMedia\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "medias";

    protected $fillable = ['disk', 'in_json', 'base_url', 'url', 'model_type', 'model_id'];
}
