<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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
// Tags Routes
Route::post('/admin/tags/delete', [TagController::class, 'delete'])->name('admin.tags.delete');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('/tags', TagController::class);
});

// Category Routes
Route::post('/admin/category/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('/category', CategoryController::class);
});

// Post Routes
Route::post('/admin/post/delete', [PostController::class, 'delete'])->name('admin.post.delete');
Route::get('/admin/post/{key}/publish', [PostController::class, 'publish'])->name('admin.post.publish');
Route::post('/admin/ckeditor/image/upload', [PostController::class, 'imageUpload'])->name('admin.ckeditor.image.upload');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('/post', PostController::class);
});
