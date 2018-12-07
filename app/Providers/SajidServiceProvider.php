<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class SajidServiceProvider extends ServiceProvider
{
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
        $this->app->bind("Sajid",function(){
            return new \App\SajidHelper\SajidHelper(config('services.facebook'));
        });
    }
}
