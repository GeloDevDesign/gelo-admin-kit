<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Users route
Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
});

Route::middleware('auth')->prefix('settings')->name('settings.')->group(function () {
    Route::resource('users', UserController::class);
});
