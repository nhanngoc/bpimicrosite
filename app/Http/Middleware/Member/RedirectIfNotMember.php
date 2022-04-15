<?php

namespace App\Http\Middleware\Member;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'member')
    {
        if (!Auth::guard($guard)->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest(route('member.login'));
        }

        return $next($request);
    }
}
