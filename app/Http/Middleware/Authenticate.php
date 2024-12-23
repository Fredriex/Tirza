<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            return route('login'); // Redirect ke halaman login jika belum login
        }
    }
}


// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Support\Facades\Auth;

// class Authenticate
// {
//     public function handle($request, Closure $next)
//     {
//         if (!Auth::check()) {
//             return redirect('/login'); // Redirect ke halaman login jika belum login
//         }

//         return $next($request);
//     }
// }

