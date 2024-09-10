<?php

namespace App\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware('auth', \App\Http\Middleware\Authenticate::class);
        Route::aliasMiddleware('auth.basic', \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class);
        Route::aliasMiddleware('auth.session', \Illuminate\Session\Middleware\AuthenticateSession::class);
        Route::aliasMiddleware('cache.headers', \Illuminate\Http\Middleware\SetCacheHeaders::class);
        Route::aliasMiddleware('can', \Illuminate\Auth\Middleware\Authorize::class);
        Route::aliasMiddleware('guest', \App\Http\Middleware\RedirectIfAuthenticated::class);
        Route::aliasMiddleware('password.confirm', \Illuminate\Auth\Middleware\RequirePassword::class);
        Route::aliasMiddleware('precognitive', \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class);
        Route::aliasMiddleware('signed', \App\Http\Middleware\ValidateSignature::class);
        Route::aliasMiddleware('throttle', \Illuminate\Routing\Middleware\ThrottleRequests::class);
        Route::aliasMiddleware('verified', \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class);
        Route::aliasMiddleware('customer.verified', \App\Http\Middleware\CustomerEmailIsVerified::class);
    }
}
