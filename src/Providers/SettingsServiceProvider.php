<?php

namespace Larashim\Settings\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Boot.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/Migrations');
        
        $this->publishes([
            __DIR__.'/../../database/Migrations' => database_path('migrations'),
        ], 'settings-migrations');
    }
}
