<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Models\Media;
use Aammui\LaravelMedia\Tests\TestModel;
use Aammui\LaravelMedia\Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

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

    /** @test */
    public function media_can_add_to_collection()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $model = TestModel::create();
        $model->toCollection('profile')
            ->addMedia($image);
        $model->toCollection('cover')
            ->addMedia($image);
        $model->addMedia($image);
        $this->assertEquals(1, $model->fromCollection('profile')->getMedia()->count());
        $this->assertEquals(1, $model->fromCollection('cover')->getMedia()->count());
        $this->assertEquals(3, $model->getMedia()->count());
    }

    /** @test */
    public function media_can_add_from_path()
    {
        $path = __DIR__ . '/TestFiles/sample.pdf';
        $model = TestModel::create();
        $model->toCollection('profile')
            ->addMediaFromPath($path);
        $this->assertEquals(1, $model->getMedia()->count());
    }

    /** @test */
    public function media_can_add_from_url()
    {
        $url = "http://www.africau.edu/images/default/sample.pdf";
        $model = TestModel::create();
        $model->toCollection('profile')
            ->addMediaFromUrl($url);
        $model->toCollection('image')
            ->addMediaFromUrl("http://esikai.com/storage/documents/ya7Sl6DTqJPgQZ06wLKPQr2Thf26V1snFRseU70w.jpeg");
        $this->assertEquals(2, $model->getMedia()->count());
        // $this->assertEquals(
        //     "https://picsum.photos/200/300",
        //     $model->fromCollection('image')
        //         ->getMedia()->first()->link()
        // );
    }
}
