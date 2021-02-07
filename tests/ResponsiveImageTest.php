<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Enum\Extension;
use Aammui\LaravelMedia\Enum\Responsive;
use Aammui\LaravelMedia\Service\ImageResponsiveService;
use Illuminate\Http\UploadedFile;

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
}
