<?php

namespace ctf\Http\Middleware;

use Auth;
use Closure;
use ErrorException;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = Auth::user();
            if ($user->permission->permissao == getenv('ADMIN_PERM')) {
                return $next($request);
            }
        } catch (ErrorException $exception) {
            return redirect()->route("root");
        }
        return redirect()->route("root");
    }
}
