<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$urlPrefix = app()->master->urlPrefix;
$routePrefix = app()->master->routePrefix;

// Tags Routes
Route::post("$urlPrefix/tags/delete", [TagController::class, "delete"])->name($routePrefix."tags.delete");
Route::group(["prefix" => "$urlPrefix", "as" => "admin."], function() {
    Route::resource("/tags", TagController::class);
});

// Category Routes
Route::post("$urlPrefix/category/delete", [CategoryController::class, "delete"])->name($routePrefix."category.delete");
Route::group(["prefix" => "$urlPrefix", "as" => "admin."], function() {
    Route::resource("/category", CategoryController::class);
});

// Post Routes
Route::post("$urlPrefix/admin/post/delete", [PostController::class, "delete"])->name($routePrefix."post.delete");
Route::get("$urlPrefix/admin/post/{key}/publish", [PostController::class, "publish"])->name($routePrefix."post.publish");
Route::post("$urlPrefix/admin/ckeditor/image/upload", [PostController::class, "imageUpload"])->name($routePrefix."ckeditor.image.upload");
Route::group(["prefix" => "$urlPrefix", "as" => "admin."], function() {
    Route::resource("/post", PostController::class);
});
