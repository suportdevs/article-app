<?php

use Illuminate\Support\Facades\Route;

$urlPrefix = app()->master->urlPrefix;
$routePrefix = app()->master->routePrefix;

Route::get('/', function () {
    return view('welcome');
});

Route::get($urlPrefix .'/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['admin:admin'])->name('admin.dashboard');

Route::get($urlPrefix .'/dashboard', function () {    
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
