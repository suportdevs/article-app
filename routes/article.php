<?php

use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$urlPrefix = app()->master->urlPrefix;
$routePrefix = app()->master->routePrefix;

// Tags Routes
Route::post("$urlPrefix/tags/delete", [TagController::class, "delete"])->name($routePrefix."tags.delete");
Route::group(["prefix" => "$urlPrefix", "as" => "$routePrefix"], function() {
    Route::resource("/tags", TagController::class);
});

// Category Routes
Route::post("$urlPrefix/category/delete", [CategoryController::class, "delete"])->name($routePrefix."category.delete");
Route::group(["prefix" => "$urlPrefix", "as" => "$routePrefix"], function() {
    Route::resource("/category", CategoryController::class);
});

// Post Routes
Route::post("$urlPrefix/post/delete", [PostController::class, "delete"])->name($routePrefix."post.delete");
Route::post("$urlPrefix/post/approved", [PostController::class, "approved"])->name($routePrefix."post.approved");
Route::post("$urlPrefix/ckeditor/image/upload", [PostController::class, "imageUpload"])->name($routePrefix."ckeditor.image.upload");
Route::group(["prefix" => "$urlPrefix", "as" => "$routePrefix"], function() {
    Route::resource("/post", PostController::class);
});

// subscriber routes
Route::post("$urlPrefix/subscriber/delete", [SubscriberController::class, "delete"])->name($routePrefix."subscriber.delete");
Route::group(["prefix" => "$urlPrefix", "as" => "$routePrefix"], function() {
    Route::resource("/subscriber", SubscriberController::class);
});
