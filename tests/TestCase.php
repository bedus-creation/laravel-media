<?php

namespace Aammui\LaravelMedia\Tests;

use Aammui\LaravelMedia\LaravelMediaServiceProvider;
use CreateMediasTable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{

    public function setUp(): void
    {
        parent::setUp();

        // setup databases
        $this->setUpDatabase($this->app);
    }
    /**
     * Define environment setup.
     *
     * @param  Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('filesystems.default', 'local');
        $app['config']->set('filesystems.disks', [
            'local' => [
                'driver' => 'local',
                'root' => __DIR__ . '/../storage/app',
            ],
            'public' => [
                'driver' => 'local',
                'root' => __DIR__ . '/../storage/app/public',
                'url' => env('APP_URL') . '/storage',
                'visibility' => 'public',
            ],
        ]);
    }

    /**
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelMediaServiceProvider::class
        ];
    }

    /**
     * Set up the database.
     *
     * @param Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
        });

        require_once __DIR__ . "/../database/migrations/2018_08_01_054830_create_medias_table.php";
        (new CreateMediasTable())->up();
    }
}
