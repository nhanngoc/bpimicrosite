<?php

namespace App\Http\Middleware\Seller;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'seller')
    {
        if (Auth::guard($guard)->check()) {

            return redirect(route('seller.dashboard'));
        }
        return $next($request);
    }
}
