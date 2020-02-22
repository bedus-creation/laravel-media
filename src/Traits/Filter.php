<?php

namespace Aammui\LaravelMedia\Traits;

class Filter
{
    protected $builder;

    public function apply($builder)
    {
        return $this->builder;
    }
}
