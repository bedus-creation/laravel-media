<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Enum\Responsive;
use Aammui\LaravelMedia\Models\Media;
use Illuminate\Http\UploadedFile;

/**
 * Class DocumentTest
 * @package Aammui\LaravelMedia\Tests
 */
class DocumentTest extends TestCase
{
    /** @test */
    public function document_can_attached_to_a_model()
    {
        $pdf   = UploadedFile::fake()->create('document.pdf', 100);
        $model = TestModel::create();
        $model->addMedia($pdf);

        // Assert built url is valid
        foreach (Responsive::getConfig() as $key => $responsive) {
            $this->assertRegExp("/http\:\/\/localhost\/documents\/.*/", $model->getMedia()->first()->link($key));
        }
    }
}
