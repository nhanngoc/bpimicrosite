<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Support\Arr;

class Authenticate extends BaseAuthenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param array $guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (!$guards) {
            $route = $request->route()->getAction();
            $flag = Arr::get($route, 'permission', Arr::get($route, 'as'));
            if ($flag && !\Auth::user()->hasAnyPermission((array)$flag)) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Unauthenticated.'], 401);
                }
                return redirect()->route('dashboard.index')->with('message', 'You don\'t have permission to access this page!!!');
            }
        }
        return $next($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @throws AuthenticationException
     */
    public function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $guard = $guards[0];
        if ($guard == 'admin') {
            $request->path = 'admin.';
        } else {
            $request->path = '';
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        return route($request->path . 'access.login');
    }
}
