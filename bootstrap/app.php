<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // Redirect guests and authenticated users with locale
        $middleware->redirectGuestsTo(function ($request) {
            $locale = $request->route('locale') ?? session('locale', 'en');
            return route('login', ['locale' => $locale]);
        });

        $middleware->redirectUsersTo(function ($request) {
            $locale = $request->route('locale') ?? session('locale', 'en');
            return route('users.index', ['locale' => $locale]);
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
