<?php

namespace App\Providers;

use App\Services\MasterAppServiceProvider;
use Illuminate\Support\ServiceProvider;

class MasterProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind('master', function(){
            return new MasterAppServiceProvider();
        });
    }
}
