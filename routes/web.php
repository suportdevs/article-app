<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
$urlPrefix = app()->master->urlPrefix;
$routePrefix = app()->master->routePrefix;
// dd(authenticateUser());

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
