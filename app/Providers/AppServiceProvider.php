<?php

namespace App\Providers;

use App\Services\MasterAppServiceProvider;
use App\Services\MasterService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind('master', function(){
            return new MasterAppServiceProvider();
        });
        Paginator::useBootstrap();
    }
}
