<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\userProfileDataService;

class userprofileModel extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Services\userProfileDataService', function( $check ){
            return new userProfileDataService();
        });
    }
}
