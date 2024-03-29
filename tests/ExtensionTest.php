<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Enum\Extension;
use Aammui\LaravelMedia\Enum\Responsive;

/**
 * Class ExtensionTest
 * @package Aammui\LaravelMedia\Tests
 */
class ExtensionTest extends TestCase
{
    /**
     * @dataProvider imageExtensionProvider
     *
     * @test
     */
    public function it_detects_if_the_given_extension_is_image($extension)
    {
        $this->assertTrue(Extension::isImage($extension));
    }

    /**
     * @dataProvider documentExtensionProvider
     *
     * @test
     */
    public function it_detects_if_the_given_extension_is_documents($extension)
    {
        $this->assertTrue(Extension::isDocument($extension));
    }

    /**
     * @return \string[][]
     */
    public static function imageExtensionProvider(): array
    {
        return [
            ["jpg"],
            ["png"],
        ];
    }

    /**
     * @return \string[][]
     */
    public static function documentExtensionProvider(): array
    {
        return [
            ["pdf"],
            ["docx"],
        ];
    }
}
