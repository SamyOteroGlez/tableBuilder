<?php

namespace App\Providers;

use App\Html\TableBuilder;
use Illuminate\Support\ServiceProvider;

class TableBuilderProvider extends ServiceProvider
{
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
        $this->app->singleton(TableBuilder::class, function () {
            return new TableBuilder();
        });
    }
}
