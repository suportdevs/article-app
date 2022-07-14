<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/admin/tags/delete', [TagController::class, 'delete'])->name('admin.tags.delete');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('/tags', TagController::class);
});
