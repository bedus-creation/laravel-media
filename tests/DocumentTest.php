<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Enum\Responsive;
use Aammui\LaravelMedia\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class DocumentTest
 * @package Aammui\LaravelMedia\Tests
 */
class DocumentTest extends TestCase
{
    /** @test */
    public function document_can_attached_to_a_model()
    {
        Storage::fake();

        $pdf   = UploadedFile::fake()->create('document.pdf', 100);
        $model = TestModel::create();
        $model->addMedia($pdf);

        // Assert built url is valid and file is stored.
        foreach (Responsive::getConfig() as $key => $responsive) {

            $this->assertEqualsIgnoringCase("http://localhost/documents/".$pdf->hashName(), $model->getMedia()
                ->first()
                ->link($key));

            $this->assertFileExists(__DIR__."/../storage/app/public/documents/".$pdf->hashName());
        }
    }
}
