<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{
        // Daftarkan middleware custom
        Route::middlewareGroup('role', [
            \App\Http\Middleware\RoleMiddleware::class,
        ]);

        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
    }
}
