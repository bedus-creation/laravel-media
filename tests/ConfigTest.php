<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\Enum\Responsive;

/**
 * Class ConfigTest
 * @package Aammui\LaravelMedia\Tests
 */
class ConfigTest extends TestCase
{
    /** @test */
    public function get_config_function_returns_all_default_values()
    {
        $this->assertCount(3, Responsive::getConfig());
    }

    /** @test */
    public function get_config_height_returns_default_width_for_key()
    {
        $this->assertEquals(config('laravel-media.responsive.sm.w'), Responsive::getWidthFromConfig(Responsive::SM));
    }

    /** @test */
    public function get_config_height_returns_default_height_for_key()
    {
        $this->assertEquals(config('laravel-media.responsive.sm.h'), Responsive::getHeightFromConfig(Responsive::SM));
    }
}
