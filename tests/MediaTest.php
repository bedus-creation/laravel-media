<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Tests\TestModel;
use Aammui\LaravelMedia\Tests\TestCase;

class MediaTest extends TestCase
{

    /** @test */
    public function it_can_create_media()
    {
        $model = TestModel::create();
        dd($model);
        $this->assertTrue(true);
    }
}
