<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store']);
    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

use App\Http\Controllers\ProfileController;

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware(['throttle:6,1'])->name('verification.send');

    Route::middleware('verified')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->name('avatar.update');

        Route::resource('projects', ProjectController::class)->only(['index', 'store', 'update', 'destroy']);

        Route::get('/', function () {
            return Inertia::render('Home');
        })->name('home');

        Route::get('/settings', function () {
            return Inertia::render('Settings');
        })->name('settings');

        Route::get('/settings/user', function () {
            return Inertia::render('Settings/User');
        })->name('settings.user');

        Route::get('/settings/general', function () {
            return Inertia::render('Settings/General');
        })->name('settings.general');

        Route::get('/settings/backups', function () {
            return Inertia::render('Settings/Backups');
        })->name('settings.backups');

        Route::get('/my-files', function () {
            return Inertia::render('MyFiles');
        })->name('my-files');

        Route::get('/my-files/resume', function () {
            return Inertia::render('My-files/Resume');
        })->name('my-files.resume');

        Route::get('/my-files/images/vacation', function () {
            return Inertia::render('My-files/Images/Vacation');
        })->name('my-files.images.vacation');

        Route::get('/my-files/images/work', function () {
            return Inertia::render('MyFiles/Images/Work');
        })->name('my-files.images.work');

        // Breadcrumb Test Route
        Route::get('/deep/nested/level/page', function () {
            return Inertia::render('Deep/Nested/Level/Page');
        })->name('deep.test');
    });
});
