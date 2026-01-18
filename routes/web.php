<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ShowLoginFormController;
use App\Http\Controllers\Logs\LogController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

// Redirect root to login with default locale
Route::get('/', function () {
    $locale = session('locale', 'ar');
    if (auth()->check()) {
        return redirect()->route('users.index', ['locale' => $locale]);
    }
    return redirect()->route('login', ['locale' => $locale]);
});

// Localized Routes
Route::prefix('{locale}')->where(['locale' => 'ar|en'])->group(function () {

    // Guest Routes (only for non-authenticated users)
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', ShowLoginFormController::class)->name('login');
        Route::post('/login', LoginController::class)->name('login.attempt');
    });

    // Auth Routes
    Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

    // Protected Routes
    Route::middleware(['auth'])->group(function () {

        // Users routes
        Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/list', 'list')->name('list');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Logs routes
        Route::prefix('logs')->name('logs.')->controller(LogController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/list', 'list')->name('list');
        });
    });
});
