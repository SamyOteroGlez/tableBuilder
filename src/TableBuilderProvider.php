<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TableBuilderProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tableBuilder', function() {
            return new TableBuilder;
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['tableBuilder'];
    }
}
