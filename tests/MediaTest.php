<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Enum\Responsive;
use Aammui\LaravelMedia\Models\Media;
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

        // Assert built url is valid
        foreach (Responsive::getConfig() as $key => $responsive) {
            $this->assertRegExp("/http\:\/\/localhost\/{$key}\/.*/", $model->getMedia()->first()->link($key));
        }
    }

    /** @test */
    public function media_can_add_to_collection()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $model = TestModel::create();
        $model->toCollection('profile')->addMedia($image);
        $model->toCollection('cover')->addMedia($image);
        $model->addMedia($image);
        $this->assertEquals(1, $model->fromCollection('profile')->getMedia()->count());
        $this->assertEquals(1, $model->fromCollection('cover')->getMedia()->count());
        $this->assertEquals(3, $model->getMedia()->count());
    }

    /**
     * @test
     *
     * @todo Fix file upload from directory
     */
    public function media_can_add_from_path()
    {
//        $path = __DIR__ . '/TestFiles/sample.pdf';
//        $model = TestModel::create();
//        $model->toCollection('profile')
//            ->addMediaFromPath($path);
//        $this->assertEquals(1, $model->getMedia()->count());

        $this->markTestSkipped();
    }

    /** @test */
    public function media_can_add_from_url()
    {
        $url   = "http://www.africau.edu/images/default/sample.pdf";
        $model = TestModel::create();

        $model->toCollection('document')->addMediaFromUrl($url);
        $this->assertEquals(
            $url,
            $model->fromCollection('document')->getMedia()->first()->link()
        );
    }

    /** @test */
    public function multiple_media_can_linked_from_server()
    {
        $url   = "http://www.africau.edu/images/default/sample.pdf";
        $model = TestModel::create();
        $model->toCollection('document')->addMediaFromUrl($url);
        $this->assertEquals(
            $url,
            $model->fromCollection('document')->getMedia()->first()->link()
        );

        $url = "https://picsum.photos/200/300";
        $model->toCollection('image')->addMediaFromUrl($url);
        $this->assertEquals(2, $model->getMedia()->count());
        $this->assertEquals(
            $url,
            $model->fromCollection('image')->getMedia()->first()->link()
        );
    }
}
