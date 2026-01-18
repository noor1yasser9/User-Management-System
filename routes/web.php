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
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Logs routes
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
        Route::get('/logs/list', [LogController::class, 'list'])->name('logs.list');
    });
});
