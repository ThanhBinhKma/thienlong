<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $models = array(
            'Posts',
            'Drivers',
            'Users',
            'DriverBookOptions',
            'UserPosts',
            'DriverCars',
            'DriverPosts',
            'UserBooks',
            'Cars',
            'Cities',
            'DriverBooks',
            'Searches'
        );
        foreach ($models as $idx => $model) {
            $this->app->bind("App\Repositories\\{$model}Repository", 
                "App\Repositories\Eloquent\\{$model}RepositoryEloquent");
        }
    }
}
