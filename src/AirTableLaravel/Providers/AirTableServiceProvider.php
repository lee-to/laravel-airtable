<?php

namespace AirTableLaravel\Providers;

use Illuminate\Support\ServiceProvider;
use AirTableLaravel\AirTableManager;

/**
 * Class AirTableServiceProvider
 * @package App\Sources\AirTableLaravel\Providers
 */
class AirTableServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('airtable.php'),
            ], 'config');
        }
    }

    /**
     *
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'airtable');

        $this->app->singleton('airtable', function ($app) {
            return new AirTableManager($app);
        });


        $this->app->singleton('airtable.default_table', function () {
            return $this->app['airtable']->table($this->getDefaultTable());
        });
    }

    /**
     * @return mixed
     */
    protected function getDefaultTable()
    {
        return $this->app['config']['airtable.default_table'];
    }
}