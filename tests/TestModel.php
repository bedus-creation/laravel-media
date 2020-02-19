<?php

namespace Aammui\LaravelMedia\Tests;

use Illuminate\Database\Eloquent\Model;
use Aammui\LaravelMedia\Traits\HasMedia;

class TestModel extends Model
{
    use HasMedia;

    protected $fillable = ['email'];

    public $timestamps = false;
}
