<?php

namespace App\Http\Middleware;

use Closure;

class CheckUnionid
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
        $unionid = session('unionid');
        if (empty($unionid)) {
            if (env('APP_ENV') == 'local') {
                session(['unionid' => env('UNIONID')]);
                return $next($request);
            }
            return redirect()->route('oauth');
        }
        return $next($request);
    }
}
