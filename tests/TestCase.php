<?php

namespace Larashim\Settings\Tests;

use Illuminate\Support\Facades\Schema;
use Larashim\Settings\Tests\Models\Cat;
use Larashim\Settings\Tests\Models\Person;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setup()
    {
        parent::setup();

        $this->app->setBasePath(__DIR__.'/../');

        $this->loadMigrationsFrom(__DIR__.'/../src/Migrations');

        $this->artisan('migrate');

        Schema::create('people', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('cats', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Cat::create(['name' => 'Furry Cat']);
        Person::create(['name' => 'John Doe']);
    }

    protected function getPackageProviders($app)
    {
        return [
            \Larashim\Settings\SettingsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
