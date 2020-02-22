<?php

namespace Aammui\LaravelMedia\Service\Interfaces;

interface MediaInterface
{
    public function getMediaData($userId);
    public function link($data, $size = "big");
}
