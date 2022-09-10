<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use App\Services\MasterAppServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        // if(Auth::check()){
            // app()->bind('master', function(){
            //     return new MasterAppServiceProvider();
            // });
        // }
        Paginator::useBootstrap();
    }
}
