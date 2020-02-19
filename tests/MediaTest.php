<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Models\Media;
use Aammui\LaravelMedia\Tests\TestModel;
use Aammui\LaravelMedia\Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class MediaTest extends TestCase
{

    /** @test */
    public function media_can_attached_to_a_model()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $model = TestModel::create();
        $model->addMedia($image);
        $this->assertEquals(1, count(Media::all()));
    }

    /** @test */
    public function media_can_retrive_to_a_model()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $model = TestModel::create();
        $model->addMedia($image);
        $model->addMedia($image);
        $this->assertInstanceOf(Collection::class, $model->getMedia());
        $this->assertInstanceOf(Media::class, $model->getMedia()->first());
        $this->assertEquals(2, $model->getMedia()->count());
    }
}
