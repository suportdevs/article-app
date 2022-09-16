<?php

use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->middleware('adminGuest')
                ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store'])->middleware('adminGuest');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->middleware('adminGuest')
                ->name('admin.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('adminGuest');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('admin.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('admin.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('admin.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('admin.password.update');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin:admin'], function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');
});

Route::post("suportdevs/users/delete", [SubscriberController::class, "delete"])->name("suportdevs.users.delete");
Route::group(['prefix' => 'suportdevs', 'as' => 'suportdevs.'], function() {
    Route::get("/user/{key}/access", [UserController::class, "access"])->name("user.access");
    Route::post("/user/{id}/access", [UserController::class, "saveAccess"])->name("user.access.store");
    Route::resource('/users', UserController::class);
    Route::get('/profile-update', [UserProfileController::class, 'profileUpdate'])->name('suportdevs.profile-update');
    Route::resource('/profile', UserProfileController::class);
});