<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Tests\TestCase;
use Aammui\LaravelMedia\Facades\Media;
use Aammui\LaravelMedia\Models\Media as ModelsMedia;
use Illuminate\Http\UploadedFile;

class StandAloneMediaTest extends TestCase
{
    /** @test */
    public function standalone_media_can_create()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $this->assertInstanceOf(ModelsMedia::class, Media::addMedia($image));
        $this->assertEquals(1, count(Media::all()));
    }

    /** @test */
    public function standalone_media_can_add_to_collection()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        Media::toCollection('profile')
            ->addMedia($image);
        Media::toCollection('cover')
            ->addMedia($image);
        Media::addMedia($image);
        $this->assertEquals(1, Media::fromCollection('profile')->getMedia()->count());
        $this->assertEquals(1, Media::fromCollection('cover')->getMedia()->count());
        $this->assertEquals(3, Media::getMedia()->count());
    }
}
