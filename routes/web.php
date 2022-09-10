<?php

use App\Services\MasterAppServiceProvider;
use App\Traits\Master;
use Illuminate\Support\Facades\Route;
dd(new MasterAppServiceProvider());
$urlPrefix = master()->urlPrefix;
$routePrefix = master()->routePrefix;

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
