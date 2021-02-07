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
        Media::toCollection('profile')->addMedia($image);
        Media::toCollection('cover')->addMedia($image);
        Media::addMedia($image);
        $this->assertEquals(1, Media::fromCollection('profile')->getMedia()->count());
        $this->assertEquals(1, Media::fromCollection('cover')->getMedia()->count());
        $this->assertEquals(3, Media::getMedia()->count());
    }

    /** @test */
    public function standalone_media_can_add_from_path()
    {
        $path = __DIR__.'/TestFiles/sample.pdf';
        Media::toCollection('profile')->addMediaFromPath($path);
        $this->assertEquals(1, Media::getMedia()->count());
    }

    /** @test */
    public function media_can_add_from_url()
    {
        $url = "http://www.africau.edu/images/default/sample.pdf";
        Media::toCollection('profile')->addMediaFromUrl($url);


        $url = "https://picsum.photos/200/300";
        Media::toCollection('image')->addMediaFromUrl($url);
        $this->assertEquals(2, Media::getMedia()->count());
        $this->assertEquals(
            $url,
            Media::fromCollection('image')->getMedia()->first()->link()
        );
    }
}
