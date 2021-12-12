<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Enum\Extension;
use Aammui\LaravelMedia\Enum\Responsive;
use Aammui\LaravelMedia\Models\Media;
use Aammui\LaravelMedia\Service\ImageResponsiveService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

/**
 * Class ResponsiveImageTest
 * @package Aammui\LaravelMedia\Tests
 */
class ResponsiveImageTest extends TestCase
{
    /** @test */
    public function responsive_images_url_can_access()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $model = TestModel::create();

        // Add Media to $model
        $model->addMedia($image);

        $image = $model->setMediaType(Extension::IMAGE)->getMedia()->first();
        $this->assertNotNull($image->link(Responsive::SM));
        $this->assertNotNull($image->link(Responsive::MD));
        $this->assertNotNull($image->link(Responsive::LG));
    }

    /** @test */
    public function it_generates_valid_url_for_all_the_responsive_images()
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
            $this->assertRegExp(
                "/http:\/\/localhost\/{$key}\/.*/", $model->getMedia()
                ->first()
                ->link($key)
            );
        }
    }
}
