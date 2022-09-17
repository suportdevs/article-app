<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get($urlPrefix .'/dashboard', function () {
//     return view('backend.dashboard');
// })->middleware(['admin:admin'])->name($routePrefix.'dashboard');

Route::get($urlPrefix .'/dashboard', function () {    
    return view('backend.dashboard');
})->middleware(['auth'])->name($routePrefix.'dashboard');

// Route::get('dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
