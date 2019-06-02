<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\orderPlacedService;
class orderPlaced extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind('App\Servivces\orderPlacedService', function( $app ){
            return new orderPlacedService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
