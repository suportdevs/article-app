<?php

use App\Http\Controllers\Fontend\HomeController;
use App\Services\MasterAppServiceProvider;
use App\Traits\Master;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// dd(auth()->user());
$urlPrefix = master()->urlPrefix;
$routePrefix = master()->routePrefix;

// dd(master());

//Clear View cache:
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return redirect()->back()->with('success', 'Page Refresh Successfull');
})->name('viewClear');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get($urlPrefix .'/dashboard', function () {    
    return view('backend.dashboard');
})->middleware(['auth'])->name($routePrefix.'dashboard');

require __DIR__.'/auth.php';
