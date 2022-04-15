<?php

namespace App\Http\Middleware\Seller;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotSeller
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
        if (!Auth::guard($guard)->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest(route('seller.login'));
        }

        return $next($request);
    }
}
