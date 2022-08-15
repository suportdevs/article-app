<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['admin:admin'])->name('admin.dashboard');
// Route::get('/suportdevs/dashboard', function () {
//     return view('backend.dashboard');
// })->middleware(['admin:admin'])->name('admin.dashboard');

Route::get('/dashboard', function () {    
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/suportdevs/dashboard', function () {    
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
