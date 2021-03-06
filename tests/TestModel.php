<?php

namespace Aammui\LaravelMedia\Tests;

use Illuminate\Database\Eloquent\Model;
use Aammui\LaravelMedia\Traits\HasMedia;

class TestModel extends Model
{
    use HasMedia;

    protected $table = "users";
    public $timestamps = false;
}
